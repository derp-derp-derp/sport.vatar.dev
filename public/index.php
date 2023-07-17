<?php
require_once 'template/header.php';

$rarity_color = '#8f9099';

if($sportvatar_index_found)
{
    $rarity_color = $colors[$sportvatar_index['rarity_name']];
}
?>

<style type="text/css">
img.sportvatar {
    width: 80%;
    height: auto;
    margin: 0 auto 10px auto;
}

div.highlights_container {
    border: 1px dashed <?= $rarity_color; ?>;
    margin: 0 auto 20px auto;   
    padding: 20px;
    width: calc(80% - 38px);
    height: auto;
    line-height: 28px;
}
    
.main-navigation-card {
    border: 1px solid #ddfc60;
    border-radius: 10px;
    position: relative;
    width: 97%;
    height: 175px;
    margin: 0 auto;
    -moz-box-sizing: border-box;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration: none;
    color: #ddfc60;
    font-weight: bold;
    background-color: rgba(221,252,96,0.1);
}

    .main-navigation-card:hover {
        color: #0e1617;
        background-color: #ddfc60;
    }
    
    table.index-navigation {
        width: 99%;
        margin: 0 auto;
    }
    
    table.index-navigation tr:nth-child(2) td a,
    table.index-navigation tr:nth-child(3) td a {
        margin-top: 15px;
    }
    
h1 { color: <?= $rarity_color ?>; }

#index-stats-table {
    margin: 0 auto;
    width: 45%;
}

#index-stats-table tr td {
    padding-top: 15px;
}

    #index-stats-table tr td:nth-child(1) {
        width: 70%;
    }
    
    #index-stats-table tr td:nth-child(2) {
        width: 30%;
    }

#index-traits-table,
#index-sportbits-table {
    margin: 0 auto;
    width: 50%;
}

#index-stats-table tr td:nth-child(1) {
    text-align: left;
    font-family: "Korolev-Compressed-Bold";
    font-size: 200%;
}

#index-stats-table tr td:nth-child(2) {
    text-align: right;
    font-size: 150%;
}

#index-stats-table tr td.stats-span {
    font-size: 300%;
    text-align: center;
}

#abilities_detail {
    display: none;
    font-size: 120% !important;
    text-align: center !important;
    font-family: monospace !important;
}

    #abilities_detail span {
        font-family: "Korolev-Compressed-Bold";
        display: block;
        margin-bottom: 10px;
    }

    #abilities_detail_expand {
        cursor: pointer;
        font-size: 100%;
        color: #ddfc60;
    }
    
.welcome-message {
    color: #ffffff;
    text-align: center;
    padding: 0 0 15px 0;
}

/* mobile */
@media screen and (max-width: 800px) {
    #index-stats-table {
        margin: 0 auto;
        width: 50%;
    }
    
    #index-traits-table,
    #index-sportbits-table {
        width: 75%;
    }
    
    a.main-navigation-card {
        margin-top: 15px;
        height: 60px;
    }
    
    .welcome-message {
        padding: 0 0 5px 0;
    }
}
</style>

<table width="100%">
    <tr>
        <td valign="top">
            
            <form method="get" action="/">
            <table id="mint-lookup-form">
                <tr>
                    <td>
                        <label for="mint">Sportvatar #</label>
                    </td>
                    <td>
                        <input type="number" pattern="d\*" max="99999" id="mint" name="mint" maxlength="5" value="<?php echo ($mint == '') ? '' : $mint; ?>">
                    </td>
                    <td align="center">
                        <input type="submit" value="GO!">
                    </td>
                </tr>
            </table>
            </form>
            
            <?php
                
            if($sportvatar_index_found){
                $highlights = generate_highlights($sportvatar_index);
            ?>
            
            <table class="col-3 faux-responsive-table">
                <tr class="faux-responsive-tr">
                    <td>
                        <h1 class="sportvatar">#<?= $mint .' '. strtoupper($sportvatar_index['rarity_name']) .' '. $ability; ?></h1>
                        <img src="https://sportvatar.com/api/image/<?= $mint; ?>" class="sportvatar" style="border: 3px solid <?= $rarity_color; ?>; background-color: <?= $colors_extra_light_rgba[ $sportvatar_index['rarity_name'] ]; ?>">
                        <?php if(count($highlights) > 0){ ?>
                        
                        <h2 style="color: <?= $rarity_color; ?>; margin-bottom: 5px;">☆ &#160; HIGHLIGHTS &#160; ☆</h2>
                        
                        <div class="highlights_container">
                            <?php foreach($highlights as $highlight){ ?>
                                <span style="color: <?= $rarity_color; ?>;">★</span> <?= $highlight; ?><br>
                            <?php } // end if(count($highlights) > 1) ?>
                        </div>
                        
                        <?php } // end foreach($highlights as $highlight) ?>
                    </td>
                    <td style="font-size: 125%;">
                        <h2 class="sportvatar">RARITY SCORES</h2>
                        
                        <table id="index-stats-table" class="no-collapse">
                            <tr>
                                <td>
                                    Abilities &nbsp;<a id="abilities_detail_expand">+</a>
                                </td>
                                <td style="color: <?= $rarity_color; ?>;">
                                    <?= $ability; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" id="abilities_detail">
                                    <span>Avg. of Sportvatar.com scores:</span>
                                    
                                    Power: <?= $sportvatar_index['stat_power']/2; ?><br>
                                    Speed: <?= $sportvatar_index['stat_speed']/2; ?><br>
                                    Endurance: <?= $sportvatar_index['stat_endurance']/2; ?><br>
                                    Technique: <?= $sportvatar_index['stat_technique']/2; ?><br>
                                    Mental: <?= $sportvatar_index['stat_mental_strength']/2; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Traits
                                </td>
                                <td style="color: <?= $rarity_color; ?>;">
                                    <?= $sportvatar_index['rarity_score_traits']+0; ?>
                                </td>
                            </tr>
                            <?php if($sportvatar_index['rarity_score_sportbits'] > 0){ ?>
                            <tr>
                                <td>
                                    Sportbits
                                </td>
                                <td style="color: <?= $rarity_color; ?>;">
                                    <?= $sportvatar_index['rarity_score_sportbits']+0; ?>
                                </td>
                            </tr>
                            <?php } // end if($sportvatar_index['rarity_score_sportbits'] > 0) ?>
                            <tr>
                                <td colspan="2" class="stats-span">
                                    TOTAL &#160;
                                    <span style="color: <?= $rarity_color; ?>;">
                                        <?= sprintf("%0.1f", $sportvatar_index['rarity_score_total']+0); ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                        
                        <br>
                        
                        <p>
                            Owned By<br>
                            <span class="fixed-width-font" style="color: <?= $rarity_color ?>;"><?= $sportvatar_index['owner_flow_address']; ?></span>
                        </p>
                        
                        <?php if($sportvatar_index['owner_flow_address'] !== $sportvatar_index['minter_flow_address']){ ?>
                        <p>
                            Minted By<br>
                            <span class="fixed-width-font" style="color: <?= $rarity_color ?>;"><?= $sportvatar_index['minter_flow_address']; ?></span>
                        </p>
                        <?php } // end if($sportvatar_index['owner_flow_address'] !=== $sportvatar_index['minter_flow_address']) ?>
                        
                        <p>
                            Minted<br>
                            <span style="color: <?= $rarity_color ?>;">
                                <?= human_date($sportvatar_index['mint_date']); ?>
                            </span>
                        </p>
                        
                        <p>
                            Last Updated<br>
                            <span style="color: <?= $rarity_color ?>;">
                                <?= human_date($sportvatar_index['last_update_date']); ?>
                            </span>
                        </p>
                        
                        <br>
                        
                        <p style="font-size: 90%;">
                            <a href="https://sportvatar.com/collection/<?= $sportvatar_index['owner_flow_address']; ?>" class="text_link" target="_blank">View this Sportvatar owner's collection.</a>
                        </p>
                        
                        <?php if($sportvatar_index['owner_flow_address'] !== $sportvatar_index['minter_flow_address']){ ?>
                        <p style="font-size: 90%;">
                            <a href="https://sportvatar.com/collection/<?= $sportvatar_index['minter_flow_address']; ?>" class="text_link" target="_blank">View the original minter's collection.</a>
                        </p>
                        <?php } // end if($sportvatar_index['owner_flow_address'] !=== $sportvatar_index['minter_flow_address']) ?>
                        
                        <p style="font-size: 90%;">
                            <a href="https://sportvatar.com/sportvatars/<?= $sportvatar_index['mint_number'] .'/'. $sportvatar_index['owner_flow_address']; ?>" class="text_link" target="_blank">View official Sportvatar.com detail page.</a>
                        </p>
                        
                        <?php
                            $combination_string = $sportvatar_index['builder_combination'];
                            
                            if($sportvatar_index['sportbit_accessory_id'] > 0)
                            {
                                $combination_string .= '-L12_'.$sportvatar_index['sportbit_accessory_id'];
                            }
                        ?>
                        
                        <p style="font-size: 90%;">
                            <a href="https://sportvatar.com/builder#<?= $combination_string; ?>" target="_blank" class="text_link">View in official Sportvatar.com builder.</a>
                        </p>
                    </td>
<?php
    $all_templates_in_mint = explode(',', $sportvatar_index['templates_data']);
    $mint_templates = array();
    foreach($all_templates_in_mint as $single_template)
    {
        $single_template = explode(':', $single_template);
        
        // 0: category
        // 1: flow_id
        // 2: num minted
        // 3: rarity
        // 4: name
        $mint_templates[ $single_template[0] ] = array(
            'flow_id' => $single_template[1],
            'num_used' => $single_template[2],
            'rarity' => $single_template[3],
            'name' => $single_template[4]
        );
    }
    //echo highlight_string(print_r($mint_templates,true),true);
?>
                    <td style="font-size: 125%;">
                        <br class="mobile-only">
                        <h2 class="sportvatar">
                            TRAITS&#160;&#160;
                            <span style="color: <?= $rarity_color; ?>;">
                                <?= $sportvatar_index['rarity_score_traits']+0; ?>
                                 points
                            </span>
                        </h2>
                        
                        <table id="index-traits-table" class="no-collapse">
                            <tr><td colspan="2">&#160;</td></tr>
                            <?php foreach($traits as $trait){ ?>
                            <tr>
                                <td style="text-align: left; width: 15%;">
                                    <strong><?= ucwords(str_replace('_', ' ', $trait)); ?></strong>
                                </td>
                                <td style="text-align: left; color: <?= $colors[ $mint_templates['trait_'. $trait]['rarity'] ]; ?>;">
                                    <?= $mint_templates['trait_'. $trait]['name']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left; width: 15%;"><?= get_trait_rarity_score($sportvatar_index['trait_'. $trait .'_id'])+0; ?> points</td>
                                <td style="text-align: left;">(on <?= $mint_templates['trait_'. $trait]['num_used']; ?> other Sportvatars)</td>
                            </tr>
                            <tr><td colspan="2">&#160;</td></tr>
                            <?php } // end foreach $traits ?>
                        </table>
                        <?php
                            if($sportvatar_index['rarity_score_sportbits'] > 0){
                                $sportbit_accessory = get_template($sportvatar_index['sportbit_accessory_id']);
                        ?>
                        
                        <h2 class="sportvatar">
                            SPORTBITS&#160;&#160;
                            <span style="color: <?= $rarity_color; ?>;">
                                <?= $sportvatar_index['rarity_score_sportbits']+0; ?>
                                 points
                            </span>
                        </h2>
                        
                        <table id="index-sportbits-table" class="no-collapse">
                            <tr><td colspan="2">&#160;</td></tr>
                            <tr>
                                <td style="text-align: left; width: 15%;">
                                    <strong>Accessory</strong>
                                </td>
                                <td style="text-align: left; color: <?= $colors[ $sportbit_accessory['rarity'] ]; ?>;">
                                    <?= $sportbit_accessory['name']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left; width: 15%;"><?= get_sportbit_rarity_score($sportvatar_index['sportbit_accessory_other_sportvatar_count']+1); ?> points</td>
                                <td style="text-align: left;">(<a href="sportbit-sportvatars.php?sportbit_id=<?= $sportvatar_index['sportbit_accessory_id']; ?>" class="text_link">on <?= $sportvatar_index['sportbit_accessory_other_sportvatar_count']; ?> other Sportvatars</a>)</td>
                            </tr>
                            <tr><td colspan="2">&#160;</td></tr>
                        </table>
                        
                        <?php } // end if($sportvatar_index['rarity_score_sportbits'] > 0) ?>
                    </td>
                </tr>
            </table>
            
            <?php
                }else{
                    if(isset($_GET['mint']) && ($mint >= $num_sportvatars)){
                        echo '<p align="center">No Sportvatar #'. $mint .' found.<br>Please double-check the mint #.<br><br>If it\'s a new mint, try again in 15 minutes.</p>';
                    }
                    else
                    {
            ?>
            
            <h1 class="welcome-message">Enter mint # &uarr; or select &darr;</h1>
            
            <table class="faux-responsive-table col-4 index-navigation">
                <tr>
                    <td><a class="main-navigation-card" href="ranking-top-100-sportvatars.php">Top 100 Sportvatars</a></td>
                    <td><a class="main-navigation-card" href="ranking-top-100-collections.php">Top 100 Collections</a></td>
                    <td><a class="main-navigation-card" href="ranking-top-100-sportvatars-native.php">Top 100 Sportvatars<br>(by native abilities score)</a></td>
                    <td><a class="main-navigation-card" href="ranking-top-100-collections-native.php">Top 100 Collections<br>(by native abilities scores)</a></td>
                </tr>
                <tr>
                    <td><a class="main-navigation-card" href="sportbits.php">Sportvatars by Sportbit</a></td>
                    <td><a class="main-navigation-card" href="gallery-famous.php">Famous Sportvatars</a></td>
                    <td><a class="main-navigation-card" href="traits.php">50 Most Used Traits</a></td>
                    <td><a class="main-navigation-card" href="traits.php?view=least_used">50 Least Used Traits</a></td>
                </tr>
                <tr>
                    <td><a class="main-navigation-card" href="market-current-floor-prices.php">Current Floor Prices<br>(load time ~10 seconds)</a></td>
                    <td><a class="main-navigation-card" href="stats.php">Statistics</a></td>
                    <td><a class="main-navigation-card" href="questions-answers.php">Questions &amp; Answers</a></td>
                    <td style="vertical-align: middle !important;">
                        <h2 style="padding: 25px 0 0 0; color: #ffffff;" class="mobile-only">- More coming soon! -</h2>
                        &#160;
                    </td>
                    <td>&#160;</td>
                </tr>
            </table>
            
            <?php
                    } // end if(isset($_GET['mint']) && ($mint >= $num_sportvatars))
                } // end if($sportvatar_index_found) ?>
            
        </td>
    </tr>
    </table>
<script>
$(document).ready(function(){
    $('#abilities_detail_expand').on('click', function(e){
        e.preventDefault();
        $('#abilities_detail').toggle();
    });
});
</script>
<?php require_once 'template/footer.php'; ?>