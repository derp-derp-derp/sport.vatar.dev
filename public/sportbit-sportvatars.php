<?php
require_once 'template/header.php';

$sportbit_id = '';

if(isset($_GET['sportbit_id']))
{   
    $sportbit_id = $_GET['sportbit_id'];
}

if(is_numeric($sportbit_id))
{
    $sportvatars = general_query('SELECT * FROM sportvatars WHERE sportbit_hat_id='. $sportbit_id .' OR sportbit_accessory_id='. $sportbit_id .' OR sportbit_number_id='. $sportbit_id .';');
    
    if(!$sportbit = get_template($sportbit_id))
    {
        echo '<p align="center">Invalid Sportbit ID. Please go back and try again.</p>';
        exit;
    }
}
else
{
    echo '<p align="center">Invalid Sportbit ID. Please go back and try again.</p>';
    exit;
}
?>

<style type="text/css">

img.sportvatar {
    border: 2px solid;
    width: 55px;
    height: auto;
}

/* mobile */
@media screen and (max-width: 800px) {

}
</style>
 
<?php
    subpage_heading(
        'Sportbit: <span style="color: '. $colors[ $sportbit['rarity'] ] .'">'. $sportbit['name'] .'</span>',
        'All Sportvatars that have the <strong>'. ucfirst($sportbit['rarity']) .' '. $sportbit['name'] .' Sportbit</strong> equipped.'
    );
?>

        <table id="data-table" class="display nowrap" style="width: 100%;">
        <thead>
            <tr>
                <th>Mint #</th>
                <th data-orderable="false">Preview</th>
                <th>Score<br>Total</th>
                <th data-orderable="false">Owner</th>
                <th>Abilities<br>Average</th>
                <th>Score<br>Traits</th>
                <th>Score<br>Sportbits</th>
                <th>Created</th>
                <th>Updated</th>
                <th data-orderable="false">View</th>
            </tr>
        </thead>
        <tbody>
<?php
    foreach($sportvatars as $sportvatar)
    {
?>
            <tr>
                <td data-sort="<?= $sportvatar['mint_number']; ?>">#<?= $sportvatar['mint_number']; ?></td>
                <td style="color: <?= $colors[ $sportvatar['rarity_name'] ]; ?>; text-align: center;"><?= $sportvatar['rarity_name']; ?><br><a href="/?mint=<?= $sportvatar['mint_number']; ?>"><img src="https://sportvatar.com/api/image/<?= $sportvatar['mint_number']; ?>" style="border-color: <?= $colors[ $sportvatar['rarity_name'] ]; ?>" class="sportvatar"></a></td>
                <td><?= $sportvatar['rarity_score_total']; ?></td>
                <td class="fixed-width-font"><?= $sportvatar['owner_flow_address']; ?></td>
                <td><?= $sportvatar['ability']/2/5; ?></td>
                <td><?= $sportvatar['rarity_score_traits']; ?></td>
                <td><?= $sportvatar['rarity_score_sportbits']; ?></td>
                <td data-sort="<?= strtotime($sportvatar['mint_date']); ?>" class="fixed-width-font"><?= human_date($sportvatar['mint_date'], true); ?> UTC</td>
                <td data-sort="<?= strtotime($sportvatar['last_update_date']); ?>" class="fixed-width-font"><?= human_date($sportvatar['last_update_date'], true); ?> UTC</td>
                <td><a href="./?mint=<?= $sportvatar['mint_number']; ?>" class="text_link_bright">Click Here</a></td>
            </tr>
<?php
    } // end foreach($sportvatars as $sportvatar)
?>
        </tbody>
        </table>

<script src="./assets/js/data-table-standard-config.js"></script>
<script>
$(document).ready(function(){
    data_table_conf.language = { emptyTable: "D'oh! No Sportvatars have this Sportbit equipped." };

    $('#data-table').DataTable( data_table_conf );
});
</script>
<?php require_once 'template/footer.php'; ?>