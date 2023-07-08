<?php
require_once(__DIR__.'/../../php/config.php');
require_once(__DIR__.'/../../php/helpers.php');
    
$flow_address = '';

if(isset($_GET['flow_address']))
{   
    $flow_address = $_GET['flow_address'];
    
    if(!is_valid_flow_address($flow_address))
    {
        json_response(
            array(
                'error' => 'Invalid Flow address. Expected format: 0x followed by 16 alphanumeric characters'
            )
        );
    }
    
    $find_lookup_cadence = shell_exec($env['FLOW_CMD_PATH'] ." --network='mainnet' scripts -o 'json' execute ../../cadence/find-name-reverse-lookup.cdc ". $flow_address);
    $find_lookup_json = json_decode($find_lookup_cadence, true);
    
    if(!is_null($find_lookup_json['value']['value']))
    {
        $find_name = $find_lookup_json['value']['value'];
        json_response(
            array(
                'find_name' => $find_name
            )
        );
    }
    else
    {
        json_response(
            array(
                'find_name' => null
            )
        );
    }
}
else
{
    json_response(
        array(
            'error' => 'Missing GET parameter: flow_address'
        )
    );
}