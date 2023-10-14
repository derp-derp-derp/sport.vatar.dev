<?php

require_once('../../php/config.php');
require_once('../../php/helpers.php');

$sportvatar_index = '';
$mint = '';

if(isset($_GET['mint'])){   
    $mint = $_GET['mint'];
}else{
    $mint = 934;
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
                t1.sportbit_hat_id,
                t1.sportbit_accessory_id,
                t1.sportbit_number_id
            )
        ) AS templates_data
    FROM sportvatars AS t1
    WHERE t1.mint_number=". $mint .";";
    
    if ($result = $conn->query($sql))
    {
        $sportvatar_index = $result->fetch_array(MYSQLI_ASSOC);
        $result->close();
    }
}else{
    exit('Mint number doesn\'t exist. If it\'s a new Sportvatar then try again in 15 minutes.');
}

if(isset($_GET['name'])){
    if($_GET['name'] !== '' && strlen($_GET['name']) <= 32){
        $sportvatar_name = $_GET['name'];
    }else{
        exit('Name must be 1 to 32 characters long.');
    }
}else{
    $sportvatar_name = 'Sportvatarian';
}

$rarity_score_title = $sportvatar_index['rarity_name'];
$ability = (($sportvatar_index['ability']/2)/5)+0;
$ability = sprintf("%0.1f", $ability);

$gradient_color_1 = '#ddfc60';
$gradient_color_2 = '#1b2023';

if(isset($_GET['color_1'])){
    if(preg_match('/^#[a-f0-9]{6}$/i', urldecode($_GET['color_1']))){
        $gradient_color_1 = urldecode($_GET['color_1']);
    }else{
        exit('Left color needs to be in format e.g. #a1b2c3 (hex color code) <a href="https://htmlcolorcodes.com/" target="_blank">Get color codes here</a>');
    }
}

if(isset($_GET['color_2'])){
    if(preg_match('/^#[a-f0-9]{6}$/i', urldecode($_GET['color_2']))){
        $gradient_color_2 = urldecode($_GET['color_2']);
    }else{
        exit('Right color needs to be in format e.g. #a1b2c3 (hex color code) <a href="https://htmlcolorcodes.com/" target="_blank">Get color codes here</a>');
    }
}

$styles = array('linear_gradient', 'circles', 'isometric', 'diagonal');
$style = 'linear_gradient';

if(isset($_GET['style'])){
    if(in_array($_GET['style'], $styles)){
        $style = $_GET['style'];
    }else{
        exit('Invalid style.');
    }
}

$backgrounds = array('479', '764', '571', '573');
$background = '764';

if(isset($_GET['background'])){
    if(in_array($_GET['background'], $backgrounds)){
        $background = $_GET['background'];
    }else{
        exit('Invalid background.');
    }
}

$name_font_size = 65;
$name_length = strlen($sportvatar_name);

if($name_length >= 11){
    if($name_length >= 19){
        $name_font_size = ($name_font_size - $name_length) * .74;
    }else{
        $name_font_size = ($name_font_size - $name_length) * .85;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Passion+One&family=Shantell+Sans:ital@1&family=Suez+One&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        input { font-size: 25px; }
        
        #imageContainer {
            width: 750px;
            height: 1050px;
<?php if($style == 'linear_gradient'){ ?>
            background: linear-gradient(90deg, <?= $gradient_color_1; ?> 0%, <?= $gradient_color_2; ?> 100%);
<?php } ?>

<?php if($style == 'circles'){ ?>
            background-image: radial-gradient(circle at center center, <?= $gradient_color_2; ?>, <?= $gradient_color_1; ?>), repeating-radial-gradient(circle at center center, <?= $gradient_color_2; ?>, <?= $gradient_color_2; ?>, 10px, transparent 20px, transparent 10px);
            background-blend-mode: multiply;
<?php } ?>

<?php if($style == 'isometric'){ ?>
            background-color: <?= $gradient_color_2; ?>;
            background-image: linear-gradient(30deg, <?= $gradient_color_1; ?> 12%, transparent 12.5%, transparent 87%, <?= $gradient_color_1; ?> 87.5%, <?= $gradient_color_1; ?>), linear-gradient(150deg, <?= $gradient_color_1; ?> 12%, transparent 12.5%, transparent 87%, <?= $gradient_color_1; ?> 87.5%, <?= $gradient_color_1; ?>), linear-gradient(30deg, <?= $gradient_color_1; ?> 12%, transparent 12.5%, transparent 87%, <?= $gradient_color_1; ?> 87.5%, <?= $gradient_color_1; ?>), linear-gradient(150deg, <?= $gradient_color_1; ?> 12%, transparent 12.5%, transparent 87%, <?= $gradient_color_1; ?> 87.5%, <?= $gradient_color_1; ?>), linear-gradient(60deg, <?= $gradient_color_1; ?> 25%, transparent 25.5%, transparent 75%, <?= $gradient_color_1; ?> 75%, <?= $gradient_color_1; ?>), linear-gradient(60deg, <?= $gradient_color_1; ?> 25%, transparent 25.5%, transparent 75%, <?= $gradient_color_1; ?> 75%, <?= $gradient_color_1; ?>);
            background-size: 20px 35px;
            background-position: 0 0, 0 0, 10px 18px, 10px 18px, 0 0, 10px 18px;
<?php } ?>

<?php if($style == 'diagonal'){ ?>
            background-color: <?= $gradient_color_2; ?>;
            background-size: 10px 10px;
            background-image: repeating-linear-gradient(45deg, <?= $gradient_color_1; ?> 0, <?= $gradient_color_1; ?> 1px, <?= $gradient_color_2; ?> 0, <?= $gradient_color_2; ?> 50%);
<?php } ?>
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        .image {
            height: 755px;
            width: auto;
            position: relative;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -55%);
        }
        
        .container-rarity {
            height: 75px;
            width: 450px;
            position: relative;
            background-color: #000000;
            top: -8px;
            left: 100px;
        }
        
        .inner-rarity {
            width: 100%;
            height: 100%;
            position: absolute;
            background-color: <?= $colors[ $rarity_score_title ]; ?>;
            border: 3px solid black;
            top: -10px;
            left: -10px;
            z-index: 10;
            font-family: 'Passion One', cursive;
            text-align: center;
            font-size: 45px;
            line-height: 74px;
        }
    </style>
</head>
<body>
    <form method="get" action="<?= $_SERVER['PHP_SELF']; ?>" style="font-size: 30px; margin: 20px; font-family: 'Passion One', cursive;">
    <table>
        <tr>
            <td><label for="mint">Mint #</label>:&#160;</td>
            <td><input id="mint" name="mint" type="number" value="<?= $mint; ?>"><td>
        </tr>
        <tr>
            <td><label for="name">Name</label>:&#160;</td>
            <td><input id="name" name="name" type="text" value="<?= $sportvatar_name; ?>"><td>
        </tr>
        <tr>
            <td><label for="style">Background</label>:&#160;</td>
            <td>
                <select id="background" name="background">
                    <option value="479"<?= $background == '479' ? ' selected="selected"' : ''; ?>>Basketball</option>
                    <option value="764"<?= $background == '764' ? ' selected="selected"' : ''; ?>>Football (American)</option>
                    <option value="571"<?= $background == '571' ? ' selected="selected"' : ''; ?>>Football (Soccer)</option>
                    <option value="573"<?= $background == '573' ? ' selected="selected"' : ''; ?>>Boxing / Wrestling Ring</option>
                </select>
            <td>
        </tr>
        <tr>
            <td><label for="color_1">Border Color 1</label>:&#160;</td>
            <td><input id="color_1" name="color_1" type="color" value="<?= $gradient_color_1; ?>"><td>
        </tr>
        <tr>
            <td><label for="color_2">Border Color 2</label>:&#160;</td>
            <td><input id="color_2" name="color_2" type="color" value="<?= $gradient_color_2; ?>"><td>
        </tr>
        <tr>
            <td><label for="style">Border Style</label>:&#160;</td>
            <td>
                <select id="style" name="style">
                    <option value="linear_gradient"<?= $style == 'linear_gradient' ? ' selected="selected"' : ''; ?>>Linear Gradient</option>
                    <option value="circles"<?= $style == 'circles' ? ' selected="selected"' : ''; ?>>Concentric Circles</option>
                    <option value="isometric"<?= $style == 'isometric' ? ' selected="selected"' : ''; ?>>Isometric</option>
                    <option value="diagonal"<?= $style == 'diagonal' ? ' selected="selected"' : ''; ?>>Diagonal Lines</option>
                </select>
            <td>
        </tr>
        <tr>
            <td colspan="2" align="center">&#160;<br><input type="submit" value="Apply Changes"></td>
        </tr>
    </table>
    </form>
    
    <p style="font-family: 'Shantell Sans', cursive; padding: 30px;">(To see full card use View >> Zoom Out<br>in your browser menu.)</p>
    
    <div id="imageContainer">
        <div style="height: 892px; background-color: #ffffff; border: 6px solid #000000; margin: 54px 54px 0 54px;">
            <div style="height: 867px; border: 3px solid #000000; margin: 6px; overflow: hidden; background-image: url('https://flovatar.com/api/image/template/<?= $background; ?>'); background-size: auto 101%; background-position: center 55px;">
                
                <div style="height: 87px; background-color: #1b2023; color: #ffffff; text-align: center; float: left; width: 25%; margin: 0 auto; font-family: 'Shantell Sans', cursive; font-size: 30px; line-height: 30px;">
                    <img src="../assets/img/sportvatar-logo.svg" style="width: 70%; margin: 10px auto 0 auto;"><br>
                    #<?= $mint; ?>
                </div>
                <div style="height: 87px; background-color: #ffffff; color: #111111; padding: 0 3px; text-align: center; float: right; width: 75%; font-family: 'Suez One', serif; line-height: 87px; font-size: <?= $name_font_size; ?>px;">
                    <?= $sportvatar_name; ?>
                </div>
                <div style="clear: both;"></div>
                
                <img id="img1" class="image" src="https://sportvatar.com/api/image/<?= $mint; ?>" />

            </div>
            
            <div class="container-rarity">
                <div class="inner-rarity" style="text-transform: uppercase;"><?= $rarity_score_title. ' ' .$ability; ?></div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
require_once('../../php/close-connections.php');
exit;