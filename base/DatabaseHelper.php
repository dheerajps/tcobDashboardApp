<?php

class DatabaseHelper {

    private $connection = null;
    public $errors = null;

    /* cleanup the connection */
    public function close() {
        if ($this->connection) {
            try {
                sqlsrv_close( $this->connection );
            } catch (Exception $e) {
                $this->connection = null;
            }
        }
    }

    /* uses the default appConfig settings if nothing given */
    private function connect( $server = DATABASE_SERVER, $db = DEFAULT_DATABASE ) {
        /* close connection to reset it if it exists
        then try to reopen it */
        if ($this->connection) {
            $this->close();
        } else {
            try {
                $this->connection = sqlsrv_connect( $server, array( "Database" => $db ) );
            } catch (Exception $e) {
                $this->errors = sqlsrv_errors();
                $this->connection = null;
                return false;
            }
        }
        /* nothing went wrong, connected */
        return true;
    }

    /* get the connection, create if not existent */
    public function getConnection() {
        if ($this->connection) {
            return $this->connection;
        } else {
            if ($this->connect()) {
                return $this->connection;
            } else {
                return false;                
            }
        }
    }

    /**
     *query, prepares and executes sql
     *@param $string, the string which will be prepared and executed
     *@param $params, the array of parameters to match the ? placeholders in $string
     *@return the array of query results
     */
    public function query( $sql, $parameters = null ) {
        
        /* gather database connection, returns false on failure */
        $usable_connection = $this->getConnection();
        if (!$usable_connection) {
            return false;
        }

        /* bind parameters to the query if they exist, compile sql at database layer */
        if ($parameters) {
            $statement = sqlsrv_prepare( $usable_connection, $sql, $parameters );
        }

        /* otherwise nothing to bind, just compile procedure */
        else {
            $statement = sqlsrv_prepare( $usable_connection, $sql );
        }
        /* check compiling success */
        if ( !$statement ) {
            $this->errors = sqlsrv_errors();
            return false;
        }

        /* execute the statement */
        $result = sqlsrv_execute( $statement );
        if ( !$result ) {
            $this->errors = sqlsrv_errors();
            return false;
        }

        /* process the queries out into arrays */
        $fullDataSet = array();
        $curQuery    = array();

        /* first query */
        while( $row = sqlsrv_fetch_array( $statement ) )  {
            array_push( $curQuery, $row );
        }
        array_push( $fullDataSet,$curQuery );

        /* rest of queries */
        while ( sqlsrv_next_result( $statement ) ) {
            /* reset curQuery */
            $curQuery = array();
            while( $row = sqlsrv_fetch_array( $statement ) ) {
                array_push( $curQuery,$row );
            }
            /* add query to collection */
            array_push( $fullDataSet,$curQuery );
        }
        /* cleanup statement */
        sqlsrv_free_stmt($statement);

        /* done */
        return $fullDataSet;
    }

    /** 
     * Summary of dbExecuteSP
     * @param string $stored_procedure name of the stored procedure to execute - should include schema - ie DBO.SP_NAME etc.
     * @param array $params array of parameters in the order they are defined in the stored procedure, put in NULL for NULL params
     * @return array of arrays where each array is a returned row aka [query][row][column]
     * 
     */
    function executeStoredProcedure($stored_procedure, $params=null) {
        /* construct sql that will execute the stored proc */
        $query = "EXECUTE $stored_procedure ";
        if ( $params && count( $params ) > 0) {
            $query .= "? ";
            for ( $i = 1; $i < count( $params ); $i++ ) {
                $query .= "\n ,?";
            }
        }
        $result = $this->query( $query, $params );
        return $result;
    }
    
    public function __construct( $server = DATABASE_SERVER, $db = DEFAULT_DATABASE  ) {
        $this->connect( $server, $db );
    }

    public function __destruct() {
        $this->close();
    }
};

?>