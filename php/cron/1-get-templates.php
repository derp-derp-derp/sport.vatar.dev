<?php
require_once(__DIR__.'/../config.php');
require_once(__DIR__.'/../helpers.php');
    
    $json_url = "https://sportvatar.com/api/templates";
    
    if($json = curl_request_contents($json_url)){
        
        $all_templates = json_decode($json, true);
        $inserts = '';
        
        foreach($all_templates as $template)
        {
            $inserts .= "INSERT INTO templates (id, name, category, rarity, max_mintable, minted, flow_id, updated_at) VALUES (";
            $inserts .= $template['id'].",";
            $inserts .= "'".addslashes($template['name'])."',";
            $inserts .= "'".$layers_map['layer_'.$template['layer']]."',";
            $inserts .= "'".$template['rarity']."',";
            $inserts .= $template['max_mintable'].",";
            $inserts .= $template['minted'].",";
            $inserts .= $template['flow_id'].",";
            $inserts .= "'".$template['updated_at']."'";
            $inserts .= ");";
        }
        
        $conn->query("TRUNCATE templates");
        $conn->multi_query($inserts);
    }

    usleep(5000000);

require_once(__DIR__.'/../close-connections.php');
exec("php '". dirname(__FILE__) ."/2-add-update-sportvatars.php'");