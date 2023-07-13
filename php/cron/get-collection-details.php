<?php
require_once(__DIR__.'/../../php/config.php');
require_once(__DIR__.'/../../php/helpers.php');

$collectors = general_query("SELECT DISTINCT(owner_flow_address) FROM sportvatars;");
$collection_details_sql = "TRUNCATE `collections`;";

foreach($collectors as $collector)
{
    //////////////////////////////////////
    // default values
    
    $num_packs = 0;
    $find_name = '';
        
    //////////////////////////////////////
    // unopened packs
    
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
        
        if($packs !== '' && $packs !== "nil" && $packs !== "Result: nil")
        {
            $packs = explode(',', $packs);
            $num_packs = count($packs);
        }
    
    //////////////////////////////////////
    // .find names
    
    $find_lookup_cadence = shell_exec($env['FLOW_CMD_ABS_PATH'] ." --config-path '". $env['FLOW_SCRIPTS_ABS_PATH'] ."/flow.json' --network='mainnet' -o 'json' --log='none' scripts execute '". $env['FLOW_SCRIPTS_ABS_PATH'] ."/find-name-reverse-lookup.cdc' ". $collector['owner_flow_address']);

    $find_lookup_json = json_decode($find_lookup_cadence, true);
    
    $find_name = '';
    
    if(!is_null($find_lookup_json['value']['value']))
    {
        $find_name = $find_lookup_json['value']['value'];
    }
    
    //////////////////////////////////////
    // MySQL query
    $collection_details_sql .= "INSERT INTO collections (owner_flow_address, packs, find_name) VALUES ('" . $collector['owner_flow_address'] . "', ". $num_packs .", '". $find_name ."');";
}

$conn->multi_query($collection_details_sql);

require_once(__DIR__.'/../close-connections.php');
exit;