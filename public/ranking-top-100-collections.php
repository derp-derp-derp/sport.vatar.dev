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
        'Top 100 Sportvatar Collections',
        'Scoring includes native abilities scores + custom traits and Sportbits rarity scores.'
    );
    
    $sportvatar_collections = general_query("SELECT
        t1.owner_flow_address,
        SUM(t1.rarity_score_total) AS total_score,
        (SELECT COUNT(*) FROM sportvatars WHERE owner_flow_address = t1.owner_flow_address) AS num_sportvatars,
        (SELECT COUNT(*) FROM sportvatars WHERE rarity_name='common' AND owner_flow_address = t1.owner_flow_address) AS common_count,
        (SELECT COUNT(*) FROM sportvatars WHERE rarity_name='rare' AND owner_flow_address = t1.owner_flow_address) AS rare_count,
        (SELECT COUNT(*) FROM sportvatars WHERE rarity_name='epic' AND owner_flow_address = t1.owner_flow_address) AS epic_count,
        (SELECT COUNT(*) FROM sportvatars WHERE rarity_name='legendary' AND owner_flow_address = t1.owner_flow_address) AS legendary_count
        FROM sportvatars t1
        GROUP BY owner_flow_address
        ORDER BY total_score DESC
        LIMIT 100
    ;");
?>

        <table id="data-table" class="display nowrap" style="width: 100%;">
        <thead>
            <tr>
                <th>Rank</th>
                <th data-orderable="false">Owner</th>
                <th data-orderable="false">.find<br>name</th>
                <th>Score Total</th>
                <th>Num.<br>Sportvatars</th>
                <th>Num. Common<br>Sportvatars</th>
                <th>Num. Rare<br>Sportvatars</th>
                <th>Num. Epic<br>Sportvatars</th>
                <th>Num. Legendary<br>Sportvatars</th>
                <th data-orderable="false">View</th>
            </tr>
        </thead>
        <tbody>
<?php
    $rank = 1;
    foreach($sportvatar_collections as $collection)
    {
?>
            <tr>
                <td><?= $rank; ?></td>
                <td class="fixed-width-font"><?= $collection['owner_flow_address']; ?></td>
                <td class="fixed-width-font find_name_<?= $collection['owner_flow_address']; ?>"><a href="javascript:void(0)" class="get_find_name text_link" data-flow-address="<?= $collection['owner_flow_address']; ?>">Lookup</a></td>
                <td><?= $collection['total_score']; ?></td>
                <td><?= $collection['num_sportvatars']; ?></td>
                <td><?= $collection['common_count']; ?></td>
                <td><?= $collection['rare_count']; ?></td>
                <td><?= $collection['epic_count']; ?></td>
                <td><?= $collection['legendary_count']; ?></td>
                <td><a href="https://sportvatar.com/collection/<?= $collection['owner_flow_address']; ?>" class="text_link_bright" target="_blank">Collection</a></td>
            </tr>
<?php
        $rank++;
    } // end foreach($sportvatars as $sportvatar)
?>
        </tbody>
        </table>

<script src="./assets/js/data-table-standard-config.js"></script>
<script src="./assets/js/find-reverse-lookup-ajax.js"></script>
<script>
$(document).ready(function(){
    $('#data-table').DataTable( data_table_conf );
});
</script>
<?php require_once 'template/footer.php'; ?>