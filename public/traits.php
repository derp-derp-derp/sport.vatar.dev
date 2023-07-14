<?php
require_once 'template/header.php';

$where = "(category = 'trait_body' OR category = 'trait_clothing' OR category = 'trait_eyes' OR category = 'trait_facial_hair' OR category = 'trait_hair' OR category = 'trait_mouth' OR category = 'trait_nose')";

// default to top 50
$list_title = "50 MOST USED TRAITS";
$sql = "SELECT * FROM `templates` WHERE ".$where." ORDER BY minted DESC LIMIT 50;";
$view = '';

if(isset($_GET['view']))
{    
    $view = $_GET['view'];

    switch($view)
    {
        case 'least_used':
            $list_title = "50 LEAST USED TRAITS";
            $sql = "SELECT * FROM `templates` WHERE ".$where." ORDER BY minted, FIELD(rarity,'legendary','epic','rare','common') ASC LIMIT 50;";
        break;
    }// end switch($view)
} // end if(isset($_GET['view']))

$traits = general_query($sql);
?>

<style type="text/css">
.content-card {
    border: 1px solid;
    border-radius: 10px;
    position: relative;
    width: 95%;
    height: 175px;
    margin: 0 auto;
    -moz-box-sizing: border-box;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration: none;
    color: #ddfc60;
    font-weight: bold;
    cursor: default;
}

.content-card img {
    display: none;
    width: auto;
    height: 175px;
}

<?php foreach($rarity_names as $rarity){ ?>
    .content-card.<?= $rarity; ?> {
        color: <?= $colors[ $rarity ]; ?>;
        border-color: <?= $colors[ $rarity ]; ?>;
        background-color: <?= $colors_extra_light_rgba[ $rarity ]; ?>;
    }
    
        .content-card.<?= $rarity; ?>:hover {
            color: #000000;
            background-color: <?= $colors_muted_rgba[ $rarity ]; ?>;
        }
<?php } // end foreach($rarity_names as $rarity) ?>
    
    table.card-navigator {
        width: 99%;
        margin: 0 auto;
    }
    
        a.content-card {
            margin-top: 15px;
        }

/* mobile */
@media screen and (max-width: 800px) {
    .content-card { height: 60px; }
}
</style>

<?php
    subpage_heading(
        $list_title,
        'Computer users can mouseover a trait to see what it looks like.'
    );
?>
            
<table class="faux-responsive-table col-10 card-navigator">
<?php
    $total_items = count($traits);
    $items_per_row = 10;
    $iterations = ceil($total_items / $items_per_row);
    $index = 0;
    
    for ($i = 0; $i < $iterations; $i++)
    {
        echo "<tr>";
        for ($j = 0; $j < $items_per_row; $j++)
        {
            echo "<td>";

            if ($index < $total_items)
            {
                $trait_id = $traits[$index]['flow_id'];
                
                $trait_category = ucwords(str_replace('_', ' ', str_replace('trait_', '', $traits[$index]['category'])));
                
                echo '<a class="content-card '. $traits[$index]['rarity'] .'" href="javascript:void(0);">';
                echo '    <img src="https://sportvatar.com/api/image/template/'. $trait_id .'">';
                echo '    <span>'. ucwords($traits[$index]['rarity']) .' '. $trait_category .'<br>'. $traits[$index]['name'] .'<br>Used: '. $traits[$index]['minted'] .'</span>';
                echo '</a>';
            }
            else
            {
                // empty td
                echo '&#160;';
            }
            echo "</td>";
            $index++;
        }
        echo "</tr>";
    }
?>
</table>

<script src="./assets/js/card-hover.js"></script>
<?php require_once 'template/footer.php'; ?>