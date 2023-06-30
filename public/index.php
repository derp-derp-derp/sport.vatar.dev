<?php
require_once 'template/header.php';

$rarity_color = '#8f9099';

if($sportvatar_index_found)
{
    $rarity_color = $colors[$sportvatar_index['rarity_name']];
}
?>

<style type="text/css">
h1 { color: <?= $rarity_color ?>; }

#index-stats-table {
    margin: 0 auto;
    width: 35%;
}

#index-stats-table tr td {
    width: 50%;
    padding-top: 15px;
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
    font-size: 225%;
    text-align: center;
}
</style>

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
                    <td>
                        <input type="submit" value="GO!">
                    </td>
                </tr>
            </table>
            </form>
            
            <?php if($sportvatar_index_found){ ?>
            
            <table class="faux-responsive-table col-3">
                <tr>
                    <td>
                        <h1 class="sportvatar">#<?= $mint .' '. strtoupper($sportvatar_index['rarity_name']); ?></h1>
                        <img src="https://sportvatar.com/api/image/<?= $mint; ?>" class="sportvatar" style="border: 3px solid <?= $rarity_color; ?>; background-color: <?= $colors_extra_light_rgba[ $sportvatar_index['rarity_name'] ]; ?>">
                    </td>
                    <td>
                        <h2 class="sportvatar">RARITY SCORES</h2>
                        
                        <table id="index-stats-table">
                            <tr>
                                <td>
                                    Abilities:
                                </td>
                                <td style="color: <?= $rarity_color; ?>;">
                                    <?= ($sportvatar_index['ability']/2)+0; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Traits:
                                </td>
                                <td style="color: <?= $rarity_color; ?>;">
                                    <?= $sportvatar_index['rarity_score_traits']+0; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Sportbit:
                                </td>
                                <td style="color: <?= $rarity_color; ?>;">
                                    <?= $sportvatar_index['rarity_score_sportbits']+0; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="stats-span">
                                    TOTAL: &#160;
                                    <span style="color: <?= $rarity_color; ?>;">
                                        <?= $sportvatar_index['rarity_score_total']+0; ?>
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
                        
                        <p>
                            <a href="https://sportvatar.com/collection/<?= $sportvatar_index['owner_flow_address']; ?>" class="text_link" target="_blank">View this Sportvatar owner's collection.</a>
                        </p>
                        
                        <?php if($sportvatar_index['owner_flow_address'] !== $sportvatar_index['minter_flow_address']){ ?>
                        <p>
                            <a href="https://sportvatar.com/collection/<?= $sportvatar_index['minter_flow_address']; ?>" class="text_link" target="_blank">View the original minter's collection.</a>
                        </p>
                        <?php } // end if($sportvatar_index['owner_flow_address'] !=== $sportvatar_index['minter_flow_address']) ?>
                        
                        <p>
                            <a href="https://sportvatar.com/sportvatars/<?= $sportvatar_index['mint_number'] .'/'. $sportvatar_index['owner_flow_address']; ?>" class="text_link" target="_blank">View official Sportvatar.com detail page.</a>
                        </p>
                        
                        <?php
                            $combination_string = $sportvatar_index['builder_combination'];
                            
                            if($sportvatar_index['sportbit_accessory_id'] > 0)
                            {
                                $combination_string .= '-L12_'.$sportvatar_index['sportbit_accessory_id'];
                            }
                        ?>
                        
                        <p>
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
                    <td>
                        <h2 class="sportvatar">
                            TRAITS&#160;&#160;
                            <span style="color: <?= $rarity_color; ?>;">
                                <?= $sportvatar_index['rarity_score_traits']+0; ?>
                                 points
                            </span>
                        </h2>
                        
                        <table style="margin: 0 auto; width: 50%;">
                            <tr><td colspan="2">&#160;</td></tr>
                            <?php foreach($traits as $trait){ ?>
                            <tr>
                                <td style="text-align: left; width: 15%;">
                                    <strong><?= ucwords(str_replace('_', ' ', $trait)); ?></strong>:
                                </td>
                                <td style="text-align: left; color: <?= $colors[ $mint_templates['trait_'. $trait]['rarity'] ]; ?>;">
                                    <?= $mint_templates['trait_'. $trait]['name']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left; width: 15%;"><?= get_trait_rarity_score($sportvatar_index['trait_'. $trait .'_id'])+0; ?> points</td>
                                <td style="text-align: left;">(<a href="#" class="text_link">on <?= $mint_templates['trait_'. $trait]['num_used']; ?> other Sportvatars</a>)</td>
                            </tr>
                            <tr><td colspan="2">&#160;</td></tr>
                            <?php } // end foreach $traits ?>
                        </table>
                        <?php
                            if($sportvatar_index['sportbit_accessory_id'] > 0) {
                                $sportbit_accessory = get_template($sportvatar_index['sportbit_accessory_id']);
                        ?>
                        
                        <h2 class="sportvatar">
                            SPORTBIT&#160;&#160;
                            <span style="color: <?= $rarity_color; ?>;">
                                <?= $sportvatar_index['rarity_score_sportbits']+0; ?>
                                 points
                            </span>
                        </h2>
                        
                        <table style="margin: 0 auto; width: 50%;">
                            <tr><td colspan="2">&#160;</td></tr>
                            <tr>
                                <td style="text-align: left; width: 15%;">
                                    <strong>Accessory</strong>:
                                </td>
                                <td style="text-align: left; color: <?= $colors[ $sportbit_accessory['rarity'] ]; ?>;">
                                    <?= $sportbit_accessory['name']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left; width: 15%;"><?= get_sportbit_rarity_score($sportvatar_index['sportbit_accessory_other_sportvatar_count']+1); ?> points</td>
                                <td style="text-align: left;">(<a href="#" class="text_link">on <?= $sportvatar_index['sportbit_accessory_other_sportvatar_count']; ?> other Sportvatars</a>)</td>
                            </tr>
                            <tr><td colspan="2">&#160;</td></tr>
                        </table>
                        
                        <?php } // end if($sportvatar_index['sportbit_accessory_id'] > 0) ?>
                    </td>
                </tr>
            </table>
            
            <?php
                }else{
                    if(isset($_GET['mint']) && ($mint >= $num_sportvatars)){
                        echo 'No Sportvatar #'. $mint .' found.<br>Please double-check the mint #.<br><br>If it\'s a new mint, try again in 15 minutes.';
                    }
                    else
                    {
            ?>
                    Welcome to Sport.vatar.dev!
            <?php
                    } // end if(isset($_GET['mint']) && ($mint >= $num_sportvatars))
                } // end if($sportvatar_index_found) ?>
            
        </td>
    </tr>
            
<?php require_once 'template/footer.php'; ?>