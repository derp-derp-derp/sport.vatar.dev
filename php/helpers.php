<?php
require_once('config.php');

$rarity_names = array('common', 'rare', 'epic', 'legendary');

$traits = array('body', 'clothing', 'nose', 'mouth', 'facial_hair', 'hair', 'eyes');

$stat_names = array('technique', 'endurance', 'speed', 'power', 'mental_strength');

$colors = array(
    'common' => '#8f9099',
    'rare' => '#20eafc',
    'epic' => '#ffeb46',
    'legendary' => '#e835f0'
);

$colors_mid_rgba = array(
    'common' => 'rgba(143, 144, 153, .75)',
    'rare' => 'rgba(32, 234, 252, .75)',
    'epic' => 'rgba(255, 235, 70, .75)',
    'legendary' => 'rgba(232, 53, 240, .75)'
);

$colors_muted_rgba = array(
    'common' => 'rgba(143, 144, 153, .4)',
    'rare' => 'rgba(32, 234, 252, .4)',
    'epic' => 'rgba(255, 235, 70, .4)',
    'legendary' => 'rgba(232, 53, 240, .4)'
);

$colors_extra_light_rgba = array(
    'common' => 'rgba(143, 144, 153, .1)',
    'rare' => 'rgba(32, 234, 252, .1)',
    'epic' => 'rgba(255, 235, 70, .1)',
    'legendary' => 'rgba(232, 53, 240, .1)'
);

$layers_map = array(
    'layer_0' => 'sport_flame',
    'layer_1' => '',
    'layer_2' => 'trait_body',
    'layer_3' => 'trait_clothing',
    'layer_4' => 'trait_nose',
    'layer_5' => 'trait_mouth',
    'layer_6' => 'trait_facial_hair',
    'layer_7' => 'trait_hair',
    'layer_8' => 'trait_eyes',
    'layer_9' => '',
    'layer_10' => '',
    'layer_11' => '',
    'layer_12' => 'sportbit_accessory'
);

$num_sportvatars = get_num_sportvatars_in_db();
$num_common_sportvatars = get_num_sportvatars_in_db('common');
$num_rare_sportvatars = get_num_sportvatars_in_db('rare');
$num_epic_sportvatars = get_num_sportvatars_in_db('epic');
$num_legendary_sportvatars = get_num_sportvatars_in_db('legendary');
$sportvatars_last_updated_timestamp = get_sportvatars_last_updated_timestamp();

function subpage_heading($heading, $subtitle = '')
{
    $heading = '<div class="content-heading">
        <h1>'. $heading .'</h1>
        '. ($subtitle !== '' ? '<p>'. $subtitle .'</p>' : '') .'
    </div>';
    
    echo $heading;
}

if(isset($_SERVER['HTTP_HOST']) && stristr($_SERVER['HTTP_HOST'], 'sport.vatar.dev'))
{
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
}
else
{
    // No SSL checks for local development
    function curl_request_contents($url, $method = '', $args = array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
        
        if($method == 'post')
        {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        }
        
        if(count($args) >= 1)
        {
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
    if (null !== $token)
    {
        $headers[] = "Authorization: Bearer $token";
    }

    if (false === $data = @file_get_contents($endpoint, false, stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => $headers,
            'content' => json_encode(['query' => $query, 'variables' => $variables]),
        ]
    ])))
    {
        $error = error_get_last();
        throw new \ErrorException($error['message'], $error['type']);
    }

    return json_decode($data, true);
}

function general_query($sql_statement, $return_type = MYSQLI_ASSOC)
{
    global $conn;
    $result = $conn->query($sql_statement);
    $query_result = $result->fetch_all($return_type);
    $result->close();
    return $query_result;
}

function get_num_sportvatars_in_db($rarity = '')
{
    global $conn;
    
    $where = ($rarity !== '') ? " WHERE rarity_name='". $rarity ."'" : "";
    
    $sql_count = "SELECT COUNT(*) AS total_sportvatars FROM `sportvatars`".$where;

    if ($result_count = $conn->query($sql_count))
    {
        $count = $result_count->fetch_array(MYSQLI_ASSOC);
        $result_count->close();
        return $count['total_sportvatars'];
    }
    else
    {
        return 0;
    }
}

function updated_within_interval($interval, $last_updated)
{    
    if(strtotime($last_updated) >= strtotime($interval))
    {
        return true;
    }
    return false;
}

function get_sportvatars_last_updated_timestamp()
{
    global $conn;
    
    $sql_max_update_time = "SELECT MAX(last_update_date) as last_update_date FROM `sportvatars`";

    if ($result_max_update_time = $conn->query($sql_max_update_time))
    {
        $max_update_time = $result_max_update_time->fetch_array(MYSQLI_ASSOC);
        $result_max_update_time->close();
        return $max_update_time['last_update_date'];
    }
    else
    {
        return 0;
    }
}

function num_sportvatars_with_sportbit($sportbit_type_column, $sportbit_id)
{
    global $conn;
    
    $sql_count = "SELECT COUNT(*) AS sportbit_count FROM `sportvatars` WHERE ".$sportbit_type_column."=".$sportbit_id.";";

    $result_count = $conn->query($sql_count);
    $count = $result_count->fetch_array(MYSQLI_ASSOC);
    $result_count->close();

    return $count['sportbit_count'];
}

function get_trait_rarity_score($trait_template_id)
{
    global $conn;
    global $num_sportvatars;
    
    $count_result= $conn->query("SELECT minted FROM templates WHERE flow_id = ". $trait_template_id .";")->fetch_array();
    $num_sportvatars_with_trait = $count_result['minted'];
    
    return number_format((.01/($num_sportvatars_with_trait/$num_sportvatars)),1)+0;
}

function get_sportbit_rarity_score($num_sportvatars_using_sportbit)
{
    global $num_sportvatars;
    
    return number_format((.01/($num_sportvatars_using_sportbit/$num_sportvatars)),1)+0;
}

function iso8601_date($yyyy_mm_dd_hh_mm_ss_date)
{    
    $datetime = new DateTime($yyyy_mm_dd_hh_mm_ss_date);
    return $datetime->format('Y-m-d\TH:i:s.').substr($datetime->format('u'),0,6).'Z';
}

function human_date($iso8601_date, $short = false)
{    
    $iso8601_date = strtotime($iso8601_date);
    
    if($short){ return date('M j \'y h:i', $iso8601_date); }
    
    return date('D, M j, Y h:i', $iso8601_date) . ' UTC';
}

function get_template($template_id)
{
    global $conn;
    $sql = "SELECT * FROM templates WHERE flow_id=". $template_id.";";

    if ($result = $conn->query($sql)){
        $template = $result->fetch_array(MYSQLI_ASSOC);
        $result->close();
        return $template;
    }else{
        return false;
    }
}

function generate_highlights($sportvatar)
{
    global $stat_names;
    global $num_sportvatars;
    
    $highlights = array();
    
    if($sportvatar['mint_number'] > 1 && $sportvatar['mint_number'] <= 293)
    {
        $highlights[] = 'Minted on day 1 (May 5th, 2023 UTC)';
    }
    
    if($sportvatar['mint_number'] == 15)
    {
        $highlights[] = 'First ever epic Sportvatar';
    }
    
    if($sportvatar['mint_number'] == 366)
    {
        $highlights[] = 'First ever legendary Sportvatar';
    }
    
    $noteworthy_addresses = array(
        '0xe623cb33adb05dba' => 'Sportvatar and Flovatar',
        '0xc967ab07284b463f' => 'this website and Flov.dev'
    );
    
    if(array_key_exists($sportvatar['minter_flow_address'], $noteworthy_addresses)){
        $highlights[] = 'Minted by the creator of ' . $noteworthy_addresses[ $sportvatar['minter_flow_address'] ];
    }

    foreach($stat_names as $stat)
    {
        if($sportvatar['stat_'. $stat] == 10)
        {
            $highlights[] = 'Maximum possible '. str_replace('_', ' ', $stat) .' stat';
        }
    }
    
    // Meme mint numbers
    $meme_mints = array(69, 420, 8008, 6900, 4200, 1337, 690, 6900, 6969, 6942);
    if(in_array($sportvatar['mint_number'], $meme_mints)){
        $highlights[] = 'Meme mint number';
    }
    
    // Milestone mint numbers
    $milestone_mints = array(100, 500, 1000, 2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000);
    if(in_array($sportvatar['mint_number'], $milestone_mints)){
        $highlights[] = 'Milestone mint number';
    }
    
    // latest
    if($num_sportvatars == $sportvatar['mint_number']){
        $highlights[] = 'Newest mint';
    }
    
    // one digit mint
    if(strlen($sportvatar['mint_number']) == 1){
        $highlights[] = 'Single digit mint number';
    }
    
    // two digit mint
    if(strlen($sportvatar['mint_number']) == 2){
        $highlights[] = '2 digit mint number';
    }
    
    // repeating mint
    $repeater_mints = array(11,22,33,44,55,66,77,88,99,111,222,333,444,555,666,777,888,999,1111,2222,3333,4444,5555,6666,7777,8888,9999);
    if(in_array($sportvatar['mint_number'], $repeater_mints)){
        $highlights[] = 'Repeater mint number';
    }
    
    // consecutive mint
    $consecutive_mints = array(12,23,34,45,56,67,78,89,123,234,345,456,567,678,789,1234,2345,3456,4567,5678,6789);
    if(in_array($sportvatar['mint_number'], $consecutive_mints)){
        $highlights[] = 'Consecutive count up mint number';
    }
    
    // reverse consecutive mint
    $reverse_consecutive_mints = array(21,32,43,54,65,76,87,98,321,432,543,654,765,876,987,4321,5432,6543,7654,8765,9876);
    if(in_array($sportvatar['mint_number'], $reverse_consecutive_mints)){
        $highlights[] = 'Consecutive count down mint number';
    }
    
    return $highlights;
}