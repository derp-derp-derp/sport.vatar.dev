<?php

// speed up static page load by not requiring config and helpers on static page
// e.g. /index.php
$static_pages = array();

if(!in_array($_SERVER['PHP_SELF'], $static_pages))
{
    require_once('../php/config.php');
    require_once('../php/helpers.php');
}