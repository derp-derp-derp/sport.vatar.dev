<?php
require_once('config.php');

$rarity_names = array('common', 'rare', 'epic', 'legendary');

$colors = array(
    'common' => '#8f9099',
    'rare' => '#20eafc',
    'epic' => '#ffeb46',
    'legendary' => '#e835f0'
);

$colors_muted_rgba = array(
    'common' => 'rgba(143, 144, 153, .4)',
    'rare' => 'rgba(32, 234, 252, .4)',
    'epic' => 'rgba(255, 235, 70, .4)',
    'legendary' => 'rgba(232, 53, 240, .4)'
);

$colors_mid_rgba = array(
    'common' => 'rgba(143, 144, 153, .75)',
    'rare' => 'rgba(32, 234, 252, .75)',
    'epic' => 'rgba(255, 235, 70, .75)',
    'legendary' => 'rgba(232, 53, 240, .75)'
);

$layers_map = array(
    'layer_0' => 'sport_flame',
    'layer_1' => '',
    'layer_2' => 'trait_body',
    'layer_3' => 'trait_clothing',
    'layer_4' => 'trait_nose',
    'layer_5' => 'trait_mouth',
    'layer_6' => 'trait_facial hair',
    'layer_7' => 'trait_hair',
    'layer_8' => 'trait_eyes',
    'layer_9' => '',
    'layer_10' => '',
    'layer_11' => '',
    'layer_12' => 'sportbit_accessory'
);

if(isset($_SERVER['HTTP_HOST']) && stristr($_SERVER['HTTP_HOST'], 'sport.vatar.dev')){
    function curl_request_contents($url, $method = '', $args = array())
    {
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
        
        if($method == 'post'){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        }
        if(count($args) >= 1){
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
        }
    
        $data = curl_exec($ch);
        curl_close($ch);
    
        return $data;
    }
}else{
    // No SSL checks for local development
    function curl_request_contents($url, $method = '', $args = array()) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
        
        if($method == 'post'){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        }
        if(count($args) >= 1){
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
        }
        
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }    
}

// Thanks to "dunglas"!
// https://gist.github.com/dunglas/05d901cb7560d2667d999875322e690a
function graphql_query(string $endpoint, string $query, array $variables = [], ?string $token = null): array
{
    $headers = ['Content-Type: application/json', 'User-Agent: Sport.vatar.dev Minimal GraphQL Client'];
    if (null !== $token) {
        $headers[] = "Authorization: Bearer $token";
    }

    if (false === $data = @file_get_contents($endpoint, false, stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => $headers,
            'content' => json_encode(['query' => $query, 'variables' => $variables]),
        ]
    ]))) {
        $error = error_get_last();
        throw new \ErrorException($error['message'], $error['type']);
    }

    return json_decode($data, true);
}

function general_query( $sql_statement, $return_type = MYSQLI_ASSOC ) {
    global $conn;
    $result = $conn->query($sql_statement);
    $query_result = $result->fetch_all($return_type);
    $result->close();
    return $query_result;
}