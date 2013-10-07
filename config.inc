<?php

define('ALBUM_TITLE', '2013 旅行');

$link = mysql_connect('localhost', 'root', 'password');
if ($link) {
    mysql_select_db('gallery_statistics', $link);
    list($msec, $sec) = explode(" ", microtime());
    mysql_query(sprintf("INSERT INTO requests (request, remote_addr, request_uri, http_referer, time) VALUES ('%s', '%s', '%s', '%s', '%s');", 
        mysql_escape_string(substr(print_r(apache_request_headers(), TRUE), 0, 1000)),
        mysql_escape_string($_SERVER['REMOTE_ADDR']),
        mysql_escape_string($_SERVER['REQUEST_URI']),
        mysql_escape_string($_SERVER['HTTP_REFERER']),
        mysql_escape_string(date("Y-m-d H:i:s", $sec) . substr($msec, 1, 4))
    ));
    mysql_close($link);
}
