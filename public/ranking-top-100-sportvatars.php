<?php require_once 'template/header.php'; ?>

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
        'Top 100 Sportvatars <br class="mobile-only">by Total Rarity Score',
        'Overall rank is out of '. $num_sportvatars .' Sportvatars and includes native abilities scores + custom trait and Sportbit rarity scoring. Lower mint numbers break ties.'
    );
    
    $sportvatars = general_query('SELECT * FROM sportvatars ORDER BY rarity_score_total  DESC, mint_number ASC LIMIT 100;');
?>

        <table id="data-table" class="display nowrap" style="width: 100%;">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Mint #</th>
                <th data-orderable="false">Preview</th>
                <th>Total<br>Score</th>
                <th data-orderable="false">Owner</th>
                <th>Abilities<br>Score</th>
                <th>Traits<br>Score</th>
                <th>Sportbits<br>Score</th>
                <th>Created</th>
                <th>Updated</th>
                <th data-orderable="false">View</th>
            </tr>
        </thead>
        <tbody>
<?php
    $rank = 1;
    foreach($sportvatars as $sportvatar)
    {
        // TODO: switch to PNG image API once it's stable
        // e.g. https://images.sportvatar.com/sportvatar/png/678.png
?>
            <tr>
                <td><?= $rank; ?></td>
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
        $rank++;
    } // end foreach($sportvatars as $sportvatar)
?>
        </tbody>
        </table>

<script src="./assets/js/data-table-standard-config.js"></script>
<script>
$(document).ready(function(){
    $('#data-table').DataTable( data_table_conf );
});
</script>
<?php require_once 'template/footer.php'; ?>