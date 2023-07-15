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
    
    if ($result = $conn->query($sql))
    {
        $sportvatar_index = $result->fetch_array(MYSQLI_ASSOC);
        $sportvatar_index_found = true;
        $result->close();
    }
}

$metadata = array(
    'image' => 'https://sport.vatar.dev/assets/img/social/og-image.png',
    'title' => 'Sportvatar Collector & Fan Site - Sport.vatar.dev',
    'url' => 'https://sport.vatar.dev',
    'description' => 'Sportvatar profiles, collection leaderboards, extended rarity scoring, galleries, highlights, Sportbit filtering, and more!'
);

if($sportvatar_index_found)
{
    $ability = (($sportvatar_index['ability']/2)/5)+0;
    $ability = sprintf("%0.1f", $ability);

    $metadata = array(
        'image' => 'https://images.sportvatar.com/sportvatar/png/'. $mint .'.png?last_updated='. strtotime($sportvatar_index['last_update_date']),
        'title' => 'Sportvatar #'. $mint .' '. ucfirst($sportvatar_index['rarity_name']) .' '. $ability,
        'url' => 'https://sport.vatar.dev/?mint='. $mint,
        'description' => 'This unique Sportvatar has an extended rarity score of '. sprintf("%0.1f", $sportvatar_index['rarity_score_total']+0) .'!'
    );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="<?php echo $metadata['description']; ?>">
    <meta name="author" content="derp">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $metadata['title']; ?>">
    <meta property="og:description" content="<?php echo $metadata['description']; ?>">
    <meta property="og:url" content="<?php echo $metadata['url']; ?>">
    <meta property="og:site_name" content="Sport.vatar.dev">
    <meta property="og:image" content="<?php echo $metadata['image']; ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="<?php echo $metadata['title']; ?>">
    <meta property="og:image:type" content="image/png">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $metadata['title']; ?>">
    <meta name="twitter:description" content="<?php echo $metadata['description']; ?>">
    <meta name="twitter:site" content="@Sportvatar">
    <meta name="twitter:creator" content="@derp3x">
    <meta name="twitter:image" content="<?php echo $metadata['image']; ?>">
    
    <link rel="shortcut icon" href="./favicon.ico">
    <link rel="icon" href="./favicon-32x32.png" sizes="32x32">
    <link rel="icon" href="./favicon-16x16.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png">
    <link rel="manifest" href="./site.webmanifest">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="./assets/css/custom.css">
    <link rel="stylesheet" href="./assets/css/datatables.min.css">
    <link rel="stylesheet" href="./assets/css/fixedHeader.dataTables.min.css">
    
    <script src="./assets/js/jquery-3.7.0.min.js"></script>
    <script src="./assets/js/datatables.min.js"></script>
    <script src="./assets/js/dataTables.fixedHeader.min.js"></script>
    
    <title><?php echo $metadata['title']; ?></title>
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