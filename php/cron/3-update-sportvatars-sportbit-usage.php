<?php
require_once(__DIR__.'/../config.php');
require_once(__DIR__.'/../helpers.php');

$sportbit_types = array(
    'accessory'
);

$updates_queries = '';

foreach($sportbit_types as $sportbit_type)
{
    $sql_query = "SELECT DISTINCT(sportbit_". $sportbit_type ."_id) FROM sportvatars WHERE sportbit_". $sportbit_type ."_id > 0;";
    
    $sportbits_query = $conn->query($sql_query);
    $sportbits_results = $sportbits_query->fetch_all(MYSQLI_ASSOC);
    $sportbits_query->close();
    
    foreach($sportbits_results as $sportbit)
    {
        $other_sportvatars_with_sportbit = num_sportvatars_with_sportbit('sportbit_'. $sportbit_type .'_id', $sportbit['sportbit_'. $sportbit_type .'_id']);
        
        if($other_sportvatars_with_sportbit > 0)
        {
            $other_sportvatars_with_sportbit = $other_sportvatars_with_sportbit - 1;
        }
        
        $updates_queries .= "UPDATE sportvatars SET sportbit_". $sportbit_type ."_other_sportvatar_count = ". $other_sportvatars_with_sportbit ." WHERE sportbit_". $sportbit_type ."_id = ".$sportbit['sportbit_'. $sportbit_type .'_id'].";";
    }
}

$conn->multi_query($updates_queries);

usleep(5000000);

require_once(__DIR__.'/../close-connections.php');
exec("php '". dirname(__FILE__) ."/4-regenerate-sportvatars-rarity-scores.php'");