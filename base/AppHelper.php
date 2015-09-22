<?php
require_once(__DIR__.'/../Base/Common.php');

// sanitize for HTML output
function h($string) {
    // best practice as of #2015life
    return htmlspecialchars($string, ENT_COMPAT, 'UTF-8', false);
}

// sanitize for JavaScript output
function j($string) {
    return json_encode($string);
}

// sanitize for use in a URL
function u($string) {
    return urlencode($string);
}

// validate value has presence
function has_presence($value) {
    // trim so empty spaces don't count
	$trimmed_value = trim($value);
    // use === to avoid false positives because empty() would consider "0" to be empty
    return isset($trimmed_value) && $trimmed_value !== "";
}

// a simple file logger
function logger($level="ERROR", $message="") {
    // set file location using globals
    $log_file = LOG_PATH.LOG_FILE;
    date_default_timezone_set("America/Chicago"); // set for central
    $now = date('Y-m-d H:i:s'); // 2015-04-27 13:12:01

    // ensure all messages have a final line return
    $log_message = $now . ' ' . $level . ': ' . $message . PHP_EOL;

    if (file_put_contents($log_file, $log_message, FILE_APPEND | LOCK_EX)) {
        return true;   
    } else {
        return false;
    }

    // usage
    // logger("ERROR", "An unknown error occurred");
    // logger("DEBUG", "x is 1");
}

// convert UTC time to local
function GmtTimeToLocalTime($time) {
    date_default_timezone_set('UTC');
    $new_date = new DateTime($time);
    $new_date->setTimeZone(new DateTimeZone('America/Chicago'));
    return $new_date->format("Y-m-d G:i:s");
}

?>