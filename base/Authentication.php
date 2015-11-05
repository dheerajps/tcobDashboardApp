<?php
require_once(__DIR__.'/../Base/Common.php');
    // no access
    if (has_presence($_SERVER['HTTP_REFERRER'])) {
        header( 'Location: ' . $_SERVER['HTTP_REFERRER'] );
    } else {
        // somebody is up to no good -- log them out
        header( 'Location: '.DEFAULT_PROTOCOL.":".APP_PAGES_PATH."logout.php" );
    }
?>