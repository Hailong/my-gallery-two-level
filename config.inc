<?php

define('ALBUM_TITLE', '2013 旅行');

$link = mysql_connect('localhost', 'root', 'password');
if ($link) {
    mysql_select_db('gallery_statistics', $link);
    $data = array(
        'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
        'REQUEST_URI' => $_SERVER['REQUEST_URI'],
        'HTTP_REFERER' => $_SERVER['HTTP_REFERER'],
        'apache_request_headers' => apache_request_headers(),
    );
    mysql_query("INSERT INTO requests (request) VALUES ('" . mysql_escape_string(substr(print_r($data, TRUE), 0, 1000)) . "');");
    mysql_close($link);
}
