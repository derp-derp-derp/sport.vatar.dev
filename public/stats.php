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
        background-color: #000000;
        font-weight: bold;
    }

/* mobile */
@media screen and (max-width: 800px) {

}
</style>

<?php
    subpage_heading(
        'Statistics',
        'Sportvatar by the numbers.'
    );
?>

    <table style="width: 100%;">
        <tbody>
<?php
    foreach(get_stats() as $stat)
    {
        if(!is_array($stat))
        {
            // heading
?>
            <tr>
                <td colspan="3" class="section_head"><?php echo $stat; ?></td>
            </tr>
<?php
        }
        else
        {
            // stat
?>
            <tr style="background-color: #141c1d;">
                <td><?= $stat['stat']; ?></td>
                <td><?= $stat['amount']; ?></td>
                <td><?= $stat['extra']; ?></td>
            </tr>
<?php
        } // end else of if(!is_array($stat))
    } // end foreach(get_stats() as $stat)
?>
        </tbody>
    </table>

<?php require_once 'template/footer.php'; ?>