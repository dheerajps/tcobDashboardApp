<?php
// TODO: authentication

// make sure we have an id
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    echo 'invalid dashboard id';
    die;
}

$dashboard_id = $_GET['id'];

// TODO: do database lookup
switch ($dashboard_id) {
    case '1':
        $url = 'https://app.cyfe.com/dashboards/682/4f1e480ccb8cf101202552286564';
        break;
    case '2':
        $url = 'https://app.cyfe.com/dashboards/152138/55db4d1c89b86109024512460565';
        break;
    default:
        echo 'invalid dashboard';
        die;
}

// Mobile or Desktop
switch ($_GET['mode']) {
    case 'mobile':
        $agent = 'Mozilla/5.0 (Linux; Android 4.0.4; Galaxy Nexus Build/IMM76B) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.133 Mobile Safari/535.19';
        break;
    default:
        $agent = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36';
        break;
}

// load up data if we have a URL
if (!empty($url)) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);

    if (!preg_match('/src="https?:\/\/"/', $result)) {
        $result = preg_replace('/src="(http:\/\/([^\/]+)\/)?([^"]+)"/', "src=\"https://app.cyfe.com/\\3\"", $result);
    }
    if (!preg_match('/href="https?:\/\/"/', $result)) {
        $result = preg_replace('/href="(http:\/\/([^\/]+)\/)?([^"]+)"/', "href=\"https://app.cyfe.com/\\3\"", $result);
    }

    echo $result;
}
?>