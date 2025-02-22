<?php

add_action( 'wp_loaded', function() {

    $logpath = "^/wp-content/b35-logs/?$";
    // Ensure insert_with_markers() is declared
    require_once ABSPATH . 'wp-admin/includes/misc.php';

    // Get path to main .htaccess for WordPress
    $htaccess = trailingslashit($_SERVER['DOCUMENT_ROOT']) . ".htaccess";
    $lines = ["RedirectMatch 404 $logpath"];
    insert_with_markers($htaccess, "b35-logging", $lines);

});


function b35_log_dump($message, $scope=null, $group_by=null, $suffix = "") {
    if (!WP_DEBUG_LOG) return;
    if (!is_string($message)) $message = json_encode($message, JSON_PRETTY_PRINT);

    $logdir = WP_CONTENT_DIR . "/b35-logs/";
    if ($scope) $logdir .= "$scope/";

    switch ($group_by) {
        case "day":
            $logdir .= date ("Y-m-d")."/";
            break;
        case "week";
            $logdir .= date ("Y-W")."/";
            break;
        case "month":
            $logdir .= date ("Y-m")."/";
            break;
    }

    if(! is_dir($logdir)) {
        if (!mkdir($logdir, 0755, true) && !is_dir($logdir)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $logdir));
        }
    }

    $logfile = $logdir.date(DATE_ATOM). floor(microtime(true) * 1000) . $suffix . ".json";

    error_log($message, 3, $logfile);

}

// TODO: log cleanup
