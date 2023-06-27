<?php

// speed up static page load by not requiring config and helpers on static page
// e.g. /index.php
$static_pages = array(
    '/index.php',
);

if(!in_array($_SERVER['PHP_SELF'], $static_pages))
{
    require_once('../php/config.php');
    require_once('../php/helpers.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>SPORT.VATAR.dev</title>

    <link rel="shortcut icon" href="./favicon.ico">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="./assets/css/custom.css">
</head>

<body>
    
    <table id="main-layout-container">
        <tr id="header-row">
            <td>
                <a href="/" class="main-logo">
                    <span>SPORT.VATAR<span>.dev</span></span>
                </a>
            </td>
        </tr>
        <!-- main content row -->