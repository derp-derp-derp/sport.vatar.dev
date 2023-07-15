<?php require_once 'template/header.php'; ?>

<style type="text/css">

td {
    text-align: center;
    padding: 10px;
    font-size: 115%;
    width: 33.33%;
}

    td.section_head {
        font-size: 150%;
        width: 100%;
    }
    
    td span {
        font-size: 75%;
        line-height: 100%;
    }

/* mobile */
@media screen and (max-width: 800px) {

}
</style>

<?php
    subpage_heading(
        'Current Floor Prices',
        'Floor pricing and depth for the official <a href="https://sportvatar.com/marketplace" target="_blank" class="text_link">Sportvatar Marketplace</a>.'
    );
    
    $floor_data = get_floor_prices();
    
    // $entity_names
    // $rarity_names
    
    /*
    e.g.
    echo highlight_string(print_r($floor_prices, true), true);
    
    Array
    (
        [prices] => Array
            (
                [sport_flame_common] => 8.90
                [sport_flame_rare] => 20.00
                [sport_flame_epic] => 55.00
                [sport_flame_legendary] => 220.00
                [sportvatar_common] => 12.00
                [sportvatar_rare] => 25.00
                [sportvatar_epic] => 45.00
                [sportvatar_legendary] => 399.00
                [sportbit_common] => 3.00
                [sportbit_rare] => 5.00
                [sportbit_epic] => 35.00
                [sportbit_legendary] => 599.00
            )
    
        [depths] => Array
            (
                [sport_flame_common] => 1
                [sport_flame_rare] => 1
                [sport_flame_epic] => 1
                [sport_flame_legendary] => 1
                [sportvatar_common] => 1
                [sportvatar_rare] => 1
                [sportvatar_epic] => 1
                [sportvatar_legendary] => 1
                [sportbit_common] => 1
                [sportbit_rare] => 2
                [sportbit_epic] => 1
                [sportbit_legendary] => 1
            )
    
    )
    */
?>

    <table style="width: 100%;">
        <tbody>
            <?php foreach($entity_names as $entity){ ?>
            <tr>
                <td colspan="3" class="section_head"><?= ucwords(str_replace('_', ' ', $entity)); ?>s</td>
            </tr>
                <?php foreach($rarity_names as $rarity){ ?>
                <tr style="background-color: <?= $colors_muted_rgba[$rarity]; ?>;">
                    <td><?= ucfirst($rarity); ?></td>
                    <td>
                        <?php
                            echo '$'. $floor_data['prices'][$entity.'_'.$rarity];
                            
                            $depth = $floor_data['depths'][$entity.'_'.$rarity];
                            echo ' <span>('. $depth .')</span>';
                        ?>
                    </td>
                    <td>
                        <?php
                            $templatecat = 'flames';
                            switch($entity)
                            {
                                case 'sportvatar':
                                    $templatecat = 'sportvatar';
                                break;
                                
                                case 'sportbit':
                                    $templatecat = 'sportbits';
                                break;
                            }
                            echo '<a href="https://sportvatar.com/marketplace#templatecat='. $templatecat .'&rarity='. $rarity .'&sortby=pricelow" target="_blank" class="text_link">Market</a>';
                        ?>
                    </td>
                </tr>
                <?php } // end foreach($rarity_names as $rarity){ ?>
            <?php } // end foreach($entity_names as $entity){ ?>
        </tbody>
    </table>

<?php require_once 'template/footer.php'; ?>