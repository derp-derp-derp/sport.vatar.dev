<?php
require_once(__DIR__.'/../config.php');
require_once(__DIR__.'/../helpers.php');

    $sql = "SELECT * FROM sportvatars";

    if ($result = $conn->query($sql))
    {
        $sportvatars = $result->fetch_all(MYSQLI_ASSOC);
        
        $updates_queries = '';
        
        foreach($sportvatars as $sportvatar)
        {
            $trait_body_score = get_trait_rarity_score($sportvatar['trait_body_id']);
            $trait_clothing_score = get_trait_rarity_score($sportvatar['trait_clothing_id']);
            $trait_nose_score = get_trait_rarity_score($sportvatar['trait_nose_id']);
            $trait_mouth_score = get_trait_rarity_score($sportvatar['trait_mouth_id']);
            $trait_facial_hair_score = get_trait_rarity_score($sportvatar['trait_facial_hair_id']);
            $trait_hair_score = get_trait_rarity_score($sportvatar['trait_hair_id']);
            $trait_eyes_score = get_trait_rarity_score($sportvatar['trait_eyes_id']);
            
            // Default value for sportbits since they are optional
            $sportbit_accessory_score = 0;

            if($sportvatar['sportbit_accessory_id'] > 0)
            {
                // add 1 to include the "self" sportvatar for scoring purposes
                $sportbit_accessory_score = get_sportbit_rarity_score($sportvatar['sportbit_accessory_other_sportvatar_count']+1);
            }

            $rarity_score_traits = $trait_body_score + $trait_clothing_score + $trait_nose_score + $trait_mouth_score + $trait_facial_hair_score + $trait_hair_score + $trait_eyes_score
            ;
            $rarity_score_sportbits = $sportbit_accessory_score;
            
            $rarity_score_total = $rarity_score_traits + $rarity_score_sportbits + ($sportvatar['ability'] / 2);

            $updates_queries .= "UPDATE sportvatars SET rarity_score_traits = '".$rarity_score_traits."', rarity_score_sportbits = '".$rarity_score_sportbits."', rarity_score_total = '".$rarity_score_total."' WHERE mint_number = ".$sportvatar['mint_number'].";";
        }
        
        $conn->multi_query($updates_queries);
        
        usleep(5000000);
    }

require_once(__DIR__.'/../close_connections.php');
exit;