<?php require_once 'template/header.php'; ?>

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
        'Sportbits',
        'Select a Sportbit to see all of the Sportvatars that have it equipped.'
    );
?>
            
<table class="faux-responsive-table col-10 card-navigator">
<?php
    $sportbits = general_query("SELECT name, rarity, flow_id FROM templates WHERE category LIKE '%sportbit_accessory%' ORDER BY FIELD(rarity,'common','rare','epic','legendary'), name ASC");
    
    $total_items = count($sportbits);
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
                $sportbit_id = $sportbits[$index]['flow_id'];
                echo '<a class="content-card '. $sportbits[$index]['rarity'] .'" href="sportbit-sportvatars.php?sportbit_id='. $sportbit_id .'" id="sportbit'. $sportbit_id .'">';
                echo '    <img src="https://sportvatar.com/api/image/template/'. $sportbit_id .'">';
                echo '    <span>'. ucwords($sportbits[$index]['rarity']) .'<br>'. $sportbits[$index]['name'] .'</span>';
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

<script>
    $('.content-card').on( "mouseenter", function(){
        $(this).find("img").show();
        $(this).find("span").hide();
    }).on( "mouseleave", function(){
        $(this).find("img").hide();
        $(this).find("span").show();
    });
</script>
<?php require_once 'template/footer.php'; ?>