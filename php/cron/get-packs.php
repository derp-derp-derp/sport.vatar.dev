<?php
require_once(__DIR__.'/../../php/config.php');
require_once(__DIR__.'/../../php/helpers.php');

$collectors = general_query("SELECT DISTINCT(owner_flow_address) FROM sportvatars;");
$packs_dynamic_inventory_sql = "TRUNCATE `collections`;";

foreach($collectors as $collector){
    
    $packs = shell_exec($env['FLOW_CMD_ABS_PATH'] ." --config-path='". $env['FLOW_SCRIPTS_ABS_PATH'] ."/flow.json' --network='mainnet' --log='none' scripts execute '". $env['FLOW_SCRIPTS_ABS_PATH'] ."/get-packs-in-collection.cdc' ". $collector['owner_flow_address']);
    
    // has pack(s) response e.g.
    // Result: [8870,  8871]
    
    // does not have pack response e.g.
    // Result: []
    
    $to_replace = array(
        'Result: [',
        ']',
        ', '
    );
    
    $replace_with = array(
        '',
        '',
        ','
    );
    
    $packs = str_replace($to_replace, $replace_with, $packs);
    $packs = ltrim($packs);
    $packs = rtrim($packs);
    
    $num_packs = 0;
    
    if($packs !== '' && $packs !== "nil" && $packs !== "Result: nil")
    {
        $packs = explode(',', $packs);
        $num_packs = count($packs);
    }
    
    $packs_dynamic_inventory_sql .= "INSERT INTO collections (owner_flow_address, packs) VALUES ('" . $collector['owner_flow_address'] . "', ". $num_packs .");";
}

$conn->multi_query($packs_dynamic_inventory_sql);

require_once(__DIR__.'/../close_connections.php');
exit;