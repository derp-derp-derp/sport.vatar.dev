<?php

// speed up static page load by not requiring config and helpers on static page
// e.g. /index.php
$static_pages = array(
    '/index.php',
);

if(!in_array($_SERVER['PHP_SELF'], $static_pages) || isset($_GET['mint']))
{
    require_once('../php/config.php');
    require_once('../php/helpers.php');
}

$sportvatar_index_found = false;
$sportvatar_index = '';
$mint = '';

if(isset($_GET['mint']))
{   
    $mint = $_GET['mint'];
}

if(is_numeric($mint) && ($mint <= $num_sportvatars))
{
    $sql = "SELECT 
        t1.*,
        (
            SELECT GROUP_CONCAT(
                CONCAT(
                    t2.category,
                    ':',
                    t2.flow_id,
                    ':',
                    t2.minted,
                    ':',
                    t2.rarity,
                    ':',
                    t2.name
                )
            SEPARATOR ',')
            FROM templates AS t2
            WHERE t2.flow_id IN(
                t1.trait_body_id,
                t1.trait_clothing_id,
                t1.trait_nose_id,
                t1.trait_mouth_id,
                t1.trait_facial_hair_id,
                t1.trait_hair_id,
                t1.trait_eyes_id,
                t1.sportbit_accessory_id
            )
        ) AS templates_data
    FROM sportvatars AS t1
    WHERE t1.mint_number=". $mint .";";
    
    if ($result = $conn->query($sql)){
        $sportvatar_index = $result->fetch_array(MYSQLI_ASSOC);
        $sportvatar_index_found = true;
        $result->close();
    }
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
    <link rel="stylesheet" href="./assets/css/datatables.min.css">
    <link rel="stylesheet" href="./assets/css/fixedHeader.dataTables.min.css">
    
    <script src="./assets/js/jquery-3.7.0.min.js"></script>
    <script src="./assets/js/datatables.min.js"></script>
    <script src="./assets/js/dataTables.fixedHeader.min.js"></script>
</head>

<body>
    
    <table width="100%">
        <tr id="header-row">
            <td>
                <a href="/" class="main-logo">
                    <span>SPORT.VATAR<span>.dev</span></span>
                </a>
            </td>
        </tr>
    </table>