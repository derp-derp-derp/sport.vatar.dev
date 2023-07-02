<?php require_once 'template/header.php'; ?>
</table>

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
 
        <div class="content-heading">
            <h1>Top 100 Sportvatars by Total Rarity Score</h1>
            <p>Overall rank is out of <?= $num_sportvatars; ?> Sportvatars and includes native abilities scores + custom trait and Sportbit rarity scoring.</p>
        </div>
        
<?php
    $sportvatars = general_query('SELECT * FROM sportvatars ORDER BY rarity_score_total DESC LIMIT 100;');
?>

        <table id="example" class="display nowrap" style="width: 100%;">
        <thead>
            <tr>
                <th>Rank</th>
                <th data-orderable="false">Preview</th>
                <th>Score<br>Total</th>
                <th data-orderable="false">Owner</th>
                <th>Mint No.</th>
                <th>Abilities Score</th>
                <th>Traits Score</th>
                <th>Sportbits Score</th>
                <th>Created</th>
                <th>Updated</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
<?php
    $rank = 1;
    foreach($sportvatars as $sportvatar)
    {
?>
            <tr>
                <td><?= $rank; ?></td>
                <td style="color: <?= $colors[ $sportvatar['rarity_name'] ]; ?>; text-align: center;"><?= $sportvatar['rarity_name']; ?><br><img src="https://sportvatar.com/api/image/<?= $sportvatar['mint_number']; ?>" style="border-color: <?= $colors[ $sportvatar['rarity_name'] ]; ?>" class="sportvatar"></td>
                <td><?= $sportvatar['rarity_score_total']; ?></td>
                <td class="fixed-width-font"><?= $sportvatar['owner_flow_address']; ?></td>
                <td><?= $sportvatar['mint_number']; ?></td>
                <td><?= $sportvatar['ability']/2; ?></td>
                <td><?= $sportvatar['rarity_score_traits']; ?></td>
                <td><?= $sportvatar['rarity_score_sportbits']; ?></td>
                <td class="fixed-width-font"><?= human_date($sportvatar['mint_date'], true); ?></td>
                <td class="fixed-width-font"><?= human_date($sportvatar['last_update_date'], true); ?></td>
                <td><a href="./?mint=<?= $sportvatar['mint_number']; ?>" class="text_link_bright">Click Here</a></td>
            </tr>
<?php
        $rank++;
    } // end foreach($sportvatars as $sportvatar)
?>
        </tbody>
        </table>

<script>
$('#example').DataTable( {
    scrollX: true,
    paging: false,
    info: false,
    searching: false,
    columnDefs: [
        {"className": "dt-center", "targets": "_all"}
    ]
} );
</script>
<?php require_once 'template/footer.php'; ?>