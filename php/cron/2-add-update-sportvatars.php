<?php
require_once(__DIR__.'/../config.php');
require_once(__DIR__.'/../helpers.php');

$json_all_url = "https://sportvatar.com/api/sportvatars/all";

if($json_all = curl_request_contents($json_all_url))
{
    $sportvatars = json_decode($json_all, true);
    
    foreach($sportvatars as $sportvatar)
    {
        $sportvatar_is_new = $sportvatar['flow_id'] > $num_sportvatars;
        
        $sportvatar_is_updated = updated_within_interval('-192 hours', $sportvatar['updated_at']);

        if($sportvatar_is_new || $sportvatar_is_updated)
        {
            // drop an existing sportvatar to "update" it as a new insert below
            if($sportvatar_is_updated)
            {   
                $conn->query("DELETE FROM sportvatars WHERE mint_number = " . $sportvatar['flow_id']);
            }
            
            $mint_number = $sportvatar['flow_id'];
            $owner_flow_address = $sportvatar['flow_address'];
            $minter_flow_address = $sportvatar['creatorAddress'];
            $rarity_name = $sportvatar['rarity'];
            $rarity_score_traits = 0;
            $rarity_score_sportbits = 0;
            $rarity_score_total = 0;
            $ability = $sportvatar['ability'];
            $stat_power = $sportvatar['power'];
            $stat_speed = $sportvatar['speed'];
            $stat_endurance = $sportvatar['endurance'];
            $stat_technique = $sportvatar['technique'];
            $stat_mental_strength = $sportvatar['mentalStrength'];
            $builder_combination = $sportvatar['combination'];
            $trait_body_id = $sportvatar['body'];
            $trait_clothing_id = $sportvatar['clothing'];
            $trait_nose_id = $sportvatar['nose'];
            $trait_mouth_id = $sportvatar['mouth'];
            $trait_facial_hair_id = $sportvatar['facialHair'];
            $trait_hair_id = $sportvatar['hair'];
            $trait_eyes_id = $sportvatar['eyes'];
            $sportbit_hat_id = 0;
            $sportbit_accessory_id = 0;
            $sportbit_number_id = 0;
            
            if($sportvatar['hat'] > 0)
            {
                $sportbit_hat_id = $sportvatar['hat'];
            }
            
            if($sportvatar['accessory'] > 0)
            {
                $sportbit_accessory_id = $sportvatar['accessory'];
            }
            
            if($sportvatar['number'] > 0)
            {
                $sportbit_number_id = $sportvatar['number'];
            }
                
            $sportbit_hat_other_sportvatar_count = 0; // this gets updated by the next scheduled script
            $sportbit_accessory_other_sportvatar_count = 0; // this gets updated by the next scheduled script
            $sportbit_number_other_sportvatar_count = 0; // this gets updated by the next scheduled script
            
            $mint_date = $sportvatar['created_at'];
            $last_update_date = $sportvatar['updated_at'];
            
            $sql = "INSERT INTO sportvatars (
                    mint_number,
                    owner_flow_address,
                    minter_flow_address,
                    rarity_name,
                    rarity_score_traits,
                    rarity_score_sportbits,
                    rarity_score_total,
                    ability,
                    stat_power,
                    stat_speed,
                    stat_endurance,
                    stat_technique,
                    stat_mental_strength,
                    builder_combination,
                    trait_body_id,
                    trait_clothing_id,
                    trait_nose_id,
                    trait_mouth_id,
                    trait_facial_hair_id,
                    trait_hair_id,
                    trait_eyes_id,
                    sportbit_hat_id,
                    sportbit_hat_other_sportvatar_count,
                    sportbit_accessory_id,
                    sportbit_accessory_other_sportvatar_count,
                    sportbit_number_id,
                    sportbit_number_other_sportvatar_count,
                    mint_date,
                    last_update_date) VALUES (";
                    
                    $sql .= $mint_number.",";
                    $sql .= "'".$owner_flow_address."',";
                    $sql .= "'".$minter_flow_address."',";
                    $sql .= "'".$rarity_name."',";
                    $sql .= $rarity_score_traits.",";
                    $sql .= $rarity_score_sportbits.",";
                    $sql .= $rarity_score_total.",";
                    $sql .= $ability.",";
                    $sql .= $stat_power.",";
                    $sql .= $stat_speed.",";
                    $sql .= $stat_endurance.",";
                    $sql .= $stat_technique.",";
                    $sql .= $stat_mental_strength.",";
                    $sql .= "'".$builder_combination."',";
                    $sql .= $trait_body_id.",";
                    $sql .= $trait_clothing_id.",";
                    $sql .= $trait_nose_id.",";
                    $sql .= $trait_mouth_id.",";
                    $sql .= $trait_facial_hair_id.",";
                    $sql .= $trait_hair_id.",";
                    $sql .= $trait_eyes_id.",";
                    $sql .= $sportbit_hat_id.",";
                    $sql .= $sportbit_hat_other_sportvatar_count.",";
                    $sql .= $sportbit_accessory_id.",";
                    $sql .= $sportbit_accessory_other_sportvatar_count.",";
                    $sql .= $sportbit_number_id.",";
                    $sql .= $sportbit_number_other_sportvatar_count.",";
                    $sql .= "'".$mint_date."',";
                    $sql .= "'".$last_update_date."'";
                    $sql .= ");";

            $conn->query($sql);
            
            usleep(300000);
            
        } // end if($sportvatar_is_new || $sportvatar_is_updated)
    } // end foreach
} // end if($json_all = curl_request_contents($json_all_url))
    usleep(5000000);

require_once(__DIR__.'/../close-connections.php');
exec("php '". dirname(__FILE__) ."/3-update-sportvatars-sportbit-usage.php'");