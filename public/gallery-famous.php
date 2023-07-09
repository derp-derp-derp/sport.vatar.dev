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
    $sportvatars = array(
        'American Football',
        array('mint' => 253, 'rarity' => 'common', 'name' => 'Walter Payton'),
        array('mint' => 164, 'rarity' => 'common', 'name' => 'Dan Marino'),
        array('mint' => 531, 'rarity' => 'common', 'name' => 'Dan Marino'),
        
        'Baseball',
        array('mint' => 461, 'rarity' => 'rare', 'name' => 'Derek Jeter'),
        array('mint' => 537, 'rarity' => 'rare', 'name' => 'Barry Bonds'),
        array('mint' => 734, 'rarity' => 'rare', 'name' => 'Randy Johnson'),
        array('mint' => 793, 'rarity' => 'common', 'name' => 'Ken Griffey Jr.'),
        array('mint' => 205, 'rarity' => 'common', 'name' => 'Mike Schmidt'),
        
        'Basketball',
        array('mint' => 295, 'rarity' => 'common', 'name' => 'Austin Reaves'),
        array('mint' => 296, 'rarity' => 'rare',   'name' => 'Lebron James'),
        array('mint' => 279, 'rarity' => 'common', 'name' => 'Evan Mobley'),
        array('mint' => 533, 'rarity' => 'common', 'name' => 'Patrick Ewing'),
        array('mint' => 735, 'rarity' => 'common', 'name' => 'Larry Johnson'),
        array('mint' => 736, 'rarity' => 'common', 'name' => 'Kobe Bryant'),
        array('mint' => 572, 'rarity' => 'rare',   'name' => 'Lance Stephenson'),
        array('mint' => 731, 'rarity' => 'common', 'name' => 'Steve Nash'),
        
        'Celebrity',
        array('mint' => 378, 'rarity' => 'common', 'name' => 'Chuck Norris'),
        array('mint' => 732, 'rarity' => 'common', 'name' => 'Bam Margera'),
        
        'Cricket',
        array('mint' => 729, 'rarity' => 'common', 'name' => 'Virat Kohli'),
        array('mint' => 713, 'rarity' => 'rare',   'name' => 'Sachin Tendulkar'),
        array('mint' => 764, 'rarity' => 'common', 'name' => 'Shane Warne'),
        array('mint' => 789, 'rarity' => 'common', 'name' => 'Brian Lara'),
        
        'Fictional',
        array('mint' => 266, 'rarity' => 'common', 'name' => 'Ray Finkle'),
        array('mint' => 380, 'rarity' => 'rare',   'name' => 'Clubber Lang'),
        array('mint' => 376, 'rarity' => 'common', 'name' => 'Rocky Balboa'),
        array('mint' => 769, 'rarity' => 'common', 'name' => 'Ivan Drago'),
        array('mint' => 371, 'rarity' => 'rare',   'name' => 'Ivan Drago'),
        array('mint' => 525, 'rarity' => 'common', 'name' => 'Spike (Little Giants)'),
        array('mint' => 526, 'rarity' => 'common', 'name' => 'Charlie Conway (Mighty Ducks)'),
        array('mint' => 527, 'rarity' => 'common', 'name' => 'Happy Gilmore'),
        array('mint' => 530, 'rarity' => 'common', 'name' => 'Bobby Boucher Jr. (Waterboy)'),
        array('mint' => 428, 'rarity' => 'rare',   'name' => 'Stewie Griffin (Family Guy)'),
        array('mint' => 429, 'rarity' => 'rare',   'name' => 'Ned Flanders (The Simpsons)'),
        
        'Fighting',
        array('mint' => 534, 'rarity' => 'common', 'name' => 'Tyson Fury'),
        array('mint' => 808, 'rarity' => 'common', 'name' => 'Mike Tyson'),
        array('mint' => 281, 'rarity' => 'common', 'name' => 'Georges St-Pierre'),
        array('mint' => 733, 'rarity' => 'common', 'name' => 'Nate Diaz'),
        
        'Football',
        array('mint' => 804, 'rarity' => 'common', 'name' => 'Sunil Chhetri'),
        array('mint' => 117, 'rarity' => 'common', 'name' => 'Alessandro Del Piero'),
        array('mint' => 290, 'rarity' => 'common', 'name' => 'Pavel Nedvěd'),
        array('mint' => 292, 'rarity' => 'rare',   'name' => 'Gianluigi "Gigi" Buffon'),
        array('mint' => 293, 'rarity' => 'common', 'name' => 'David Trézéguet'),
        array('mint' => 294, 'rarity' => 'common', 'name' => 'Mauro Camoranesi'),
        array('mint' => 147, 'rarity' => 'rare',   'name' => 'Kylian Mbappé'),
        
        'Golf',
        array('mint' => 767, 'rarity' => 'common', 'name' => 'Tiger Woods'),
        
        'Ice Skating',
        array('mint' => 268, 'rarity' => 'common', 'name' => 'Tonya Harding'),
        
        'Racing',
        array('mint' => 171, 'rarity' => 'common', 'name' => 'Max Verstappen'),
        
        'Rugby',
        array('mint' => 132, 'rarity' => 'rare',   'name' => 'Antoine DuPont')
    );
    
    $total_items = count($sportvatars);
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
                if(is_array($sportvatars[$index]))
                {
                    echo '<a class="content-card '. $sportvatars[$index]['rarity'] .'" href="/?mint='. urlencode($sportvatars[$index]['mint']) .'" id="sportbit'. $sportvatars[$index]['mint'] .'">';
                    echo '    <img src="https://sportvatar.com/api/image/'. $sportvatars[$index]['mint'] .'">';
                    echo '    <span>#'. $sportvatars[$index]['mint'] .'<br>'. $sportvatars[$index]['name'] .'</span>';
                    echo '</a>';    
                }
                else
                {
                    echo '<div class="content-card">'.$sportvatars[$index].'</div>';
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
    $('.content-card').on( "mouseenter", function(){
        $(this).find("img").show();
        $(this).find("span").hide();
    }).on( "mouseleave", function(){
        $(this).find("img").hide();
        $(this).find("span").show();
    });
</script>
<?php require_once 'template/footer.php'; ?>