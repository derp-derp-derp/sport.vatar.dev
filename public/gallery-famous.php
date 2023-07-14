<?php require_once 'template/header.php'; ?>

<style type="text/css">
.content-card {
    border: 1px solid;
    border-radius: 10px;
    position: relative;
    width: 90%;
    height: 175px;
    margin: 0 auto;
    -moz-box-sizing: border-box;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration: none;
    color: #ddfc60;
    font-weight: bold;
    padding: 3px;
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
    
        a.content-card,
        div.content-card {
            margin-top: 15px;
        }

/* mobile */
@media screen and (max-width: 800px) {
    .content-card { height: 60px; }
}
</style>

<?php
    subpage_heading(
        'Famous Sportvatars',
        'Select a Sportvatar for more information.'
    );
?>
            
<table class="faux-responsive-table col-10 card-navigator">
<?php
    // $gallery_famous array is in helpers so that we can reference it for individual Sportvatar highlights
    
    $total_items = count($gallery_famous);
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
                if(is_array($gallery_famous[$index]))
                {
                    echo '<a class="content-card '. $gallery_famous[$index]['rarity'] .'" href="/?mint='. urlencode($gallery_famous[$index]['mint']) .'" id="sportbit'. $gallery_famous[$index]['mint'] .'">';
                    echo '    <img src="https://sportvatar.com/api/image/'. $gallery_famous[$index]['mint'] .'">';
                    echo '    <span>#'. $gallery_famous[$index]['mint'] .'<br>'. $gallery_famous[$index]['name'] .'</span>';
                    echo '</a>';    
                }
                else
                {
                    echo '<div class="content-card">'.$gallery_famous[$index].'</div>';
                }
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
$(document).ready(function(){
    $('.content-card').on( "mouseenter", function(){
        $(this).find("img").show();
        $(this).find("span").hide();
    }).on( "mouseleave", function(){
        $(this).find("img").hide();
        $(this).find("span").show();
    });
});
</script>
<?php require_once 'template/footer.php'; ?>