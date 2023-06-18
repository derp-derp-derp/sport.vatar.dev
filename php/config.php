<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Clear-Site-Data: "cache", "cookies", "storage", "executionContexts"');

set_time_limit(0);

date_default_timezone_set('UTC');

$env = parse_ini_file('../.env');

$conn = new mysqli(
    $env['MYSQL_HOST'],
    $env['MYSQL_USER'],
    $env['MYSQL_PASS'],
    $env['MYSQL_DATABASE']
);

if($conn->connect_error)
{
    die("The database connection failed.");
}