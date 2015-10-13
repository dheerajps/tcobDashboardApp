<?php
/* constants, passwords, dev-mode, etc. the app will break without it */
require_once( __DIR__.'/AppConfig.php' );

/* various core functions */
require_once( __DIR__.'/AppHelper.php'  );

/* controls session, forces user to be logged in, etc. */
require_once( __DIR__.'/Session.php'   );

/* functions for interacting with LDAP */
require_once( __DIR__.'/LDAP.php'      );

/* functions for interacting with the MSSQL database */
require_once( __DIR__.'/DatabaseHelper.php'  );

/* functions for more cleanly rendering our pages,
There are not a lot of them, but use them:

header(arrayOfResources('app.css', 'app.js'));
- generates the header,
- looks in Resources/css and Resources/js for the files
- e.g. this sample call will look for
--- Resources/css/app.css
--- Resources/js/app.js

- generates the footer
footer();
 */
require_once( __DIR__.'/TSTemplate.php');

/* using the templating, and this file as your require, a simple page
(In a 'Pages' directory)
will look like...
<?php
require('../Base/Common.php');
//custom redirect logic, custom library includes, custom session manipulation

// require file that interacts with database and pulls data specific to this page
// preferably put it in a separate folder
$template = new template();
$template->header(array('app.css', 'app.js'));

//custom content, render the data pulled

$template->footer();
?>
 */

?>