<?php
require_once('config.php');

$rarity_names = array('common', 'rare', 'epic', 'legendary');

$entity_names = array('sport_flame', 'sportvatar', 'sportbit');

$traits = array('body', 'clothing', 'nose', 'mouth', 'facial_hair', 'hair', 'eyes');

$stat_names = array('power', 'speed', 'endurance', 'technique', 'mental_strength');

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
    'layer_10' => 'sportbit_hat',
    'layer_11' => '',
    'layer_12' => 'sportbit_accessory',
    'layer_13' => 'sportbit_number'
);

$num_sportvatars = get_num_sportvatars_in_db();
$num_common_sportvatars = get_num_sportvatars_in_db('common');
$num_rare_sportvatars = get_num_sportvatars_in_db('rare');
$num_epic_sportvatars = get_num_sportvatars_in_db('epic');
$num_legendary_sportvatars = get_num_sportvatars_in_db('legendary');
$sportvatars_last_updated_timestamp = get_sportvatars_last_updated_timestamp();
$all_sportvatars_ranked_by_total_score = get_all_sportvatars_ranked_by_total_score();
$all_sportvatars_ranked_by_trait_score = get_all_sportvatars_ranked_by_trait_score();
$all_sportvatars_ranked_by_sportbit_score = get_all_sportvatars_ranked_by_sportbit_score();

$gallery_famous = array(
    'American Football',
    array('mint' => 253, 'rarity' => 'common', 'name' => 'Walter Payton'),
    array('mint' => 164, 'rarity' => 'common', 'name' => 'Dan Marino'),
    array('mint' => 531, 'rarity' => 'common', 'name' => 'Dan Marino'),
    
    'Baseball',
    array('mint' => 461, 'rarity' => 'rare', 'name' => 'Derek Jeter'),
    array('mint' => 537, 'rarity' => 'rare', 'name' => 'Barry Bonds'),
    array('mint' => 734, 'rarity' => 'rare', 'name' => 'Randy Johnson'),
    array('mint' => 793, 'rarity' => 'common', 'name' => 'Ken Griffey Jr.'),
    array('mint' => 205, 'rarity' => 'common', 'name' => 'Mike Schmidt'),
    
    'Basketball',
    array('mint' => 295, 'rarity' => 'common', 'name' => 'Austin Reaves'),
    array('mint' => 296, 'rarity' => 'rare',   'name' => 'Lebron James'),
    array('mint' => 279, 'rarity' => 'common', 'name' => 'Evan Mobley'),
    array('mint' => 533, 'rarity' => 'common', 'name' => 'Patrick Ewing'),
    array('mint' => 735, 'rarity' => 'common', 'name' => 'Larry Johnson'),
    array('mint' => 736, 'rarity' => 'common', 'name' => 'Kobe Bryant'),
    array('mint' => 572, 'rarity' => 'rare',   'name' => 'Lance Stephenson'),
    array('mint' => 731, 'rarity' => 'common', 'name' => 'Steve Nash'),
    
    'Celebrity',
    array('mint' => 378, 'rarity' => 'common', 'name' => 'Chuck Norris'),
    array('mint' => 732, 'rarity' => 'common', 'name' => 'Bam Margera'),
    
    'Cricket',
    array('mint' => 729, 'rarity' => 'common', 'name' => 'Virat Kohli'),
    array('mint' => 713, 'rarity' => 'rare',   'name' => 'Sachin Tendulkar'),
    array('mint' => 764, 'rarity' => 'common', 'name' => 'Shane Warne'),
    array('mint' => 789, 'rarity' => 'common', 'name' => 'Brian Lara'),
    
    'Fictional',
    array('mint' => 266, 'rarity' => 'common', 'name' => 'Ray Finkle'),
    array('mint' => 380, 'rarity' => 'rare',   'name' => 'Clubber Lang'),
    array('mint' => 376, 'rarity' => 'common', 'name' => 'Rocky Balboa'),
    array('mint' => 769, 'rarity' => 'common', 'name' => 'Ivan Drago'),
    array('mint' => 371, 'rarity' => 'rare',   'name' => 'Ivan Drago'),
    array('mint' => 525, 'rarity' => 'common', 'name' => 'Spike (Little Giants)'),
    array('mint' => 526, 'rarity' => 'common', 'name' => 'Charlie Conway (Mighty Ducks)'),
    array('mint' => 527, 'rarity' => 'common', 'name' => 'Happy Gilmore'),
    array('mint' => 530, 'rarity' => 'common', 'name' => 'Bobby Boucher Jr. (Waterboy)'),
    array('mint' => 428, 'rarity' => 'rare',   'name' => 'Stewie Griffin (Family Guy)'),
    array('mint' => 429, 'rarity' => 'rare',   'name' => 'Ned Flanders (The Simpsons)'),
    
    'Fighting',
    array('mint' => 970, 'rarity' => 'rare',   'name' => 'Rocky Balboa'),
    array('mint' => 534, 'rarity' => 'common', 'name' => 'Tyson Fury'),
    array('mint' => 808, 'rarity' => 'common', 'name' => 'Mike Tyson'),
    array('mint' => 281, 'rarity' => 'common', 'name' => 'Georges St-Pierre'),
    array('mint' => 733, 'rarity' => 'common', 'name' => 'Nate Diaz'),
    
    'Football',
    array('mint' => 804, 'rarity' => 'common', 'name' => 'Sunil Chhetri'),
    array('mint' => 117, 'rarity' => 'common', 'name' => 'Alessandro Del Piero'),
    array('mint' => 290, 'rarity' => 'common', 'name' => 'Pavel Nedvěd'),
    array('mint' => 292, 'rarity' => 'rare',   'name' => 'Gianluigi "Gigi" Buffon'),
    array('mint' => 293, 'rarity' => 'common', 'name' => 'David Trézéguet'),
    array('mint' => 294, 'rarity' => 'common', 'name' => 'Mauro Camoranesi'),
    array('mint' => 147, 'rarity' => 'rare',   'name' => 'Kylian Mbappé'),
    array('mint' => 426, 'rarity' => 'rare',   'name' => 'Diego Maradona'),
    array('mint' => 587, 'rarity' => 'rare',   'name' => 'Pierluigi Collina'),
    array('mint' => 586, 'rarity' => 'rare',   'name' => 'Stephan El Shaarawy'),
    array('mint' => 841, 'rarity' => 'common',   'name' => 'Alex Greenwood'),
    
    'Golf',
    array('mint' => 767, 'rarity' => 'common', 'name' => 'Tiger Woods'),
    
    'Ice Skating',
    array('mint' => 268, 'rarity' => 'common', 'name' => 'Tonya Harding'),
    
    'Racing',
    array('mint' => 171, 'rarity' => 'common', 'name' => 'Max Verstappen'),
    
    'Rugby',
    array('mint' => 132, 'rarity' => 'rare',   'name' => 'Antoine DuPont')
);

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

function general_query($sql_statement, $return_type = MYSQLI_ASSOC)
{
    global $conn;
    $result = $conn->query($sql_statement);
    $query_result = $result->fetch_all($return_type);
    $result->close();
    return $query_result;
}

function is_valid_flow_address($flow_address)
{    
    if(preg_match('/^0x[a-fA-F0-9]{16}$/', $flow_address) == 1)
    {
        return true;
    }
    return false;
}

function search_marketplace($args)
{
    if(!array_key_exists('nosvg', $args))
    {
        $args['nosvg'] = 1;
    }
    
    $json_url = "https://sportvatar.com/api/marketplace/search";
    $json = curl_request_contents($json_url, 'post', $args);

    return json_decode($json, true);
}

function floor_depth($prices_array)
{
    $depth = 0;

    foreach($prices_array['data'] as $floor_item)
    {
        if($prices_array['data'][0]['price'] === $floor_item['price'])
        {
            $depth++;
        }
        else
        {
            break;
        }
    }
    
    return $depth;
}

function get_floor_prices()
{
    global $conn;
    $prices = array();
    $depths = array();
    
    // Sport Flames
    
    $sport_flame_common_search = search_marketplace(array('templateid' => '1', 'sortby' => 'pricelow'));
    $prices['sport_flame_common'] = $sport_flame_common_search['data'][0]['price'];
    $depths['sport_flame_common'] = floor_depth($sport_flame_common_search);
    
    $sport_flame_rare_search = search_marketplace(array('templateid' => '3', 'sortby' => 'pricelow'));
    $prices['sport_flame_rare'] = $sport_flame_rare_search['data'][0]['price'];
    $depths['sport_flame_rare'] = floor_depth($sport_flame_rare_search);
    
    $sport_flame_epic_search = search_marketplace(array('templateid' => '4', 'sortby' => 'pricelow'));
    $prices['sport_flame_epic'] = $sport_flame_epic_search['data'][0]['price'];
    $depths['sport_flame_epic'] = floor_depth($sport_flame_epic_search);
    
    $sport_flame_legendary_search = search_marketplace(array('templateid' => '2', 'sortby' => 'pricelow'));
    $prices['sport_flame_legendary'] = ($sport_flame_legendary_search['data'][0]['price'] > 0) ? $sport_flame_legendary_search['data'][0]['price'] : 0;
    $depths['sport_flame_legendary'] = floor_depth($sport_flame_legendary_search);
    
    // Sportvatars
    
    $sportvatar_common_search = search_marketplace(array('templatecat' => 'sportvatar', 'sortby' => 'pricelow', 'rarity' => 'common'));
    $prices['sportvatar_common'] = $sportvatar_common_search['data'][0]['price'];
    $depths['sportvatar_common'] = floor_depth($sportvatar_common_search);
    
    $sportvatar_rare_search = search_marketplace(array('templatecat' => 'sportvatar', 'sortby' => 'pricelow', 'rarity' => 'rare'));
    $prices['sportvatar_rare'] = $sportvatar_rare_search['data'][0]['price'];
    $depths['sportvatar_rare'] = floor_depth($sportvatar_rare_search);
    
    $sportvatar_epic_search = search_marketplace(array('templatecat' => 'sportvatar', 'sortby' => 'pricelow', 'rarity' => 'epic'));
    $prices['sportvatar_epic'] = $sportvatar_epic_search['data'][0]['price'];
    $depths['sportvatar_epic'] = floor_depth($sportvatar_epic_search);
    
    $sportvatar_legendary_search = search_marketplace(array('templatecat' => 'sportvatar', 'sortby' => 'pricelow', 'rarity' => 'legendary'));
    $prices['sportvatar_legendary'] = ($sportvatar_legendary_search['data'][0]['price'] > 0) ? $sportvatar_legendary_search['data'][0]['price'] : 0;
    $depths['sportvatar_legendary'] = floor_depth($sportvatar_legendary_search);
    
    // Sportbits
    
    $sportbit_common_search = search_marketplace(array('templatecat' => 'sportbit', 'sortby' => 'pricelow', 'rarity' => 'common'));
    $prices['sportbit_common'] = $sportbit_common_search['data'][0]['price'];
    $depths['sportbit_common'] = floor_depth($sportbit_common_search);
    
    $sportbit_rare_search = search_marketplace(array('templatecat' => 'sportbit', 'sortby' => 'pricelow', 'rarity' => 'rare'));
    $prices['sportbit_rare'] = $sportbit_rare_search['data'][0]['price'];
    $depths['sportbit_rare'] = floor_depth($sportbit_rare_search);
    
    $sportbit_epic_search = search_marketplace(array('templatecat' => 'sportbit', 'sortby' => 'pricelow', 'rarity' => 'epic'));
    $prices['sportbit_epic'] = $sportbit_epic_search['data'][0]['price'];
    $depths['sportbit_epic'] = floor_depth($sportbit_epic_search);
    
    $sportbit_legendary_search = search_marketplace(array('templatecat' => 'sportbit', 'sortby' => 'pricelow', 'rarity' => 'legendary'));
    $prices['sportbit_legendary'] = ($sportbit_legendary_search['data'][0]['price'] > 0) ? $sportbit_legendary_search['data'][0]['price'] : 0;
    $depths['sportbit_legendary'] = floor_depth($sportbit_legendary_search);
    
    foreach($prices as $item => $price)
    {
        $price = number_format($price, 2, '.', '');
        $prices[$item] = $price;
    }
    
    return array('prices' => $prices, 'depths' => $depths);
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

function get_all_sportvatars_ranked_by_total_score(){
    global $conn;

    $result = $conn->query("SELECT * FROM sportvatars ORDER BY rarity_score_total DESC, mint_number ASC LIMIT 10000");
        
    $all_sportvatars_ranked_by_total_score = $result->fetch_all(MYSQLI_ASSOC);
    $result->close();
    
    return $all_sportvatars_ranked_by_total_score;
}

function get_all_sportvatars_ranked_by_trait_score(){
    global $conn;

    $result = $conn->query("SELECT * FROM sportvatars ORDER BY rarity_score_traits DESC, mint_number ASC LIMIT 10000");
        
    $all_sportvatars_ranked_by_trait_score = $result->fetch_all(MYSQLI_ASSOC);
    $result->close();
    
    return $all_sportvatars_ranked_by_trait_score;
}

function get_all_sportvatars_ranked_by_sportbit_score(){
    global $conn;

    $result = $conn->query("SELECT * FROM sportvatars ORDER BY rarity_score_sportbits DESC, mint_number ASC LIMIT 10000");
        
    $all_sportvatars_ranked_by_sportbit_score = $result->fetch_all(MYSQLI_ASSOC);
    $result->close();
    
    return $all_sportvatars_ranked_by_sportbit_score;
}

function get_individual_overall_rank($mint_number, $all_sportvatars_ranked_by_total_score){
    $rarity_rank = array_search($mint_number, array_column($all_sportvatars_ranked_by_total_score, 'mint_number'));
    return $rarity_rank + 1;
}

function get_individual_trait_rank($mint_number, $all_sportvatars_ranked_by_trait_score){
    $rarity_rank = array_search($mint_number, array_column($all_sportvatars_ranked_by_trait_score, 'mint_number'));
    return $rarity_rank + 1;
}

function get_individual_sportbit_rank($mint_number, $all_sportvatars_ranked_by_sportbit_score){
    $rarity_rank = array_search($mint_number, array_column($all_sportvatars_ranked_by_sportbit_score, 'mint_number'));
    return $rarity_rank + 1;
}

function generate_highlights($sportvatar)
{
    global $stat_names;
    global $num_sportvatars;
    global $gallery_famous;
    global $all_sportvatars_ranked_by_total_score;
    global $all_sportvatars_ranked_by_trait_score;
    global $all_sportvatars_ranked_by_sportbit_score;
    
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
    
    if(array_key_exists($sportvatar['minter_flow_address'], $noteworthy_addresses))
    {
        $highlights[] = 'Minted by the creator of ' . $noteworthy_addresses[ $sportvatar['minter_flow_address'] ];
    }

    $max_stats = array();
    $ability_word = 'ability';
    foreach($stat_names as $stat)
    {
        if($sportvatar['stat_'. $stat] == 10)
        {
            $max_stats[] = str_replace('_strength', '', $stat);
        }
    }
    if(count($max_stats) > 0)
    {
        if(count($max_stats) > 1){ $ability_word = 'abilities'; }
        $highlights[] = 'Maxed out '. $ability_word .': '. implode(', ', $max_stats);
    }
    
    // Meme mint numbers
    $meme_mints = array(69, 420, 8008, 6900, 4200, 1337, 690, 6900, 6969, 6942);
    if(in_array($sportvatar['mint_number'], $meme_mints))
    {
        $highlights[] = 'Meme mint number';
    }
    
    // Milestone mint numbers
    $milestone_mints = array(100, 500, 1000, 2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000);
    if(in_array($sportvatar['mint_number'], $milestone_mints))
    {
        $highlights[] = 'Milestone mint number';
    }
    
    // latest
    if($num_sportvatars == $sportvatar['mint_number'])
    {
        $highlights[] = 'Newest mint';
    }
    
    // one digit mint
    if(strlen($sportvatar['mint_number']) == 1)
    {
        $highlights[] = 'Single digit mint number';
    }
    
    // two digit mint
    if(strlen($sportvatar['mint_number']) == 2)
    {
        $highlights[] = '2 digit mint number';
    }
    
    // repeating mint
    $repeater_mints = array(11,22,33,44,55,66,77,88,99,111,222,333,444,555,666,777,888,999,1111,2222,3333,4444,5555,6666,7777,8888,9999);
    if(in_array($sportvatar['mint_number'], $repeater_mints))
    {
        $highlights[] = 'Repeater mint number';
    }
    
    // consecutive mint
    $consecutive_mints = array(12,23,34,45,56,67,78,89,123,234,345,456,567,678,789,1234,2345,3456,4567,5678,6789);
    if(in_array($sportvatar['mint_number'], $consecutive_mints))
    {
        $highlights[] = 'Consecutive count up mint number';
    }
    
    // reverse consecutive mint
    $reverse_consecutive_mints = array(21,32,43,54,65,76,87,98,321,432,543,654,765,876,987,4321,5432,6543,7654,8765,9876);
    if(in_array($sportvatar['mint_number'], $reverse_consecutive_mints))
    {
        $highlights[] = 'Consecutive count down mint number';
    }
    
    foreach($gallery_famous as $famous)
    {
        if($famous['mint'] == $sportvatar['mint_number'])
        {
            $highlights[] = $famous['name'] .' from the <a href="/gallery-famous.php" class="text_link">Famous Sportvatars gallery</a>';
            break;
        }
    }
    
    // top scores places to acknowledge
    $places = 10;
    
    // overall top scores
    $o = 1;
    while($o <= $places)
    {
        if(get_individual_overall_rank($sportvatar['mint_number'], $all_sportvatars_ranked_by_total_score) == $o)
        {
            $highlights[] = '#'.$o.' top score overall';
            break;
        }
        $o++;
    }
    
    // traits top scores
    $t = 1;
    while($t <= $places)
    {
        if(get_individual_trait_rank($sportvatar['mint_number'], $all_sportvatars_ranked_by_trait_score) == $t)
        {
            $highlights[] = '#'.$t.' top traits score';
            break;
        }
        $t++;
    }
    
    // Sportbits top scores
    $f = 1;
    while($f <= $places)
    {
        if(get_individual_sportbit_rank($sportvatar['mint_number'], $all_sportvatars_ranked_by_sportbit_score) == $f)
        {
            $highlights[] = '#'.$f.' top Sportbits score';
            break;
        }
        $f++;
    }
    
    return $highlights;
}

function get_stats()
{
    global $conn;
    global $num_sportvatars;
    global $num_common_sportvatars;
    global $num_rare_sportvatars;
    global $num_epic_sportvatars;
    global $num_legendary_sportvatars;
    
    //$sparks_count_mp = (function() { $search_mp = search_marketplace(array('templateid' => 458)); return $search_mp['total']; })();
    //$boosters_rare_count_mp = (function() { $search_mp = search_marketplace(array('templateid' => 75)); return $search_mp['total']; })();
    //$boosters_epic_count_mp = (function() { $search_mp = search_marketplace(array('templateid' => 73)); return $search_mp['total']; })();
    //$boosters_legendary_count_mp = (function() { $search_mp = search_marketplace(array('templateid' => 74)); return $search_mp['total']; })();
    
    $stats = array();
    
    $stats[] = 'Sportvatars';
    
    $days_since_launch = ceil(abs(time() - strtotime('May 5th, 2023')) / 86400);
    $stats[] = array(
        'stat' => 'Days since launch',
        'amount' => $days_since_launch,
        'extra' => 'May 5th, 2023'
    );
    
    $stats[] = array(
        'stat' => 'Total Mints',
        'amount' => $num_sportvatars,
        'extra' => '<a href="https://sportvatar.com/locker-room" target="_blank" class="text_link">Locker Room</a>'
    );
    
    $stats[] = array(
        'stat' => 'Common Mints',
        'amount' => $num_common_sportvatars,
        'extra' => '<a href="https://sportvatar.com/locker-room#rarity=common" target="_blank" class="text_link">Locker Room Commons</a>'
    );
    
    $stats[] = array(
        'stat' => 'Rare Mints',
        'amount' => $num_rare_sportvatars,
        'extra' => '<a href="https://sportvatar.com/locker-room#rarity=rare" target="_blank" class="text_link">Locker Room Rares</a>'
    );
    
    $stats[] = array(
        'stat' => 'Epic Mints',
        'amount' => $num_epic_sportvatars,
        'extra' => '<a href="https://sportvatar.com/locker-room#rarity=epic" target="_blank" class="text_link">Locker Room Epics</a>'
    );
    
    $stats[] = array(
        'stat' => 'Legendary Mints',
        'amount' => $num_legendary_sportvatars,
        'extra' => '<a href="https://sportvatar.com/locker-room#rarity=legendary" target="_blank" class="text_link">Locker Room Legendaries</a>'
    );
    
    $stats[] = array(
        'stat' => 'Mints on day 1 (May 5th, 2023 UTC)',
        'amount' => 292,
        'extra' => '<a href="https://sportvatar.com/locker-room#sortby=dateold" target="_blank" class="text_link">Locker Room Oldest First</a>'
    );
    
    $stats[] = array(
        'stat' => 'Average mints per day since day 2',
        'amount' => number_format((($num_sportvatars - 292)/($days_since_launch - 1)),1),
        'extra' => '-'
    );
    
    $with_sportbits_equipped = general_query("SELECT COUNT(*) AS sportbits_equipped_count FROM sportvatars WHERE sportbit_hat_id > 0 OR sportbit_accessory_id > 0 OR sportbit_number_id > 0;");
    
    $stats[] = array(
        'stat' => 'Mints w/ Sportbits equipped',
        'amount' => $with_sportbits_equipped[0]['sportbits_equipped_count'],
        'extra' => '<a href="sportbits.php" class="text_link">Filter by Sportbit</a>'
    );
    
    $stats[] = 'Collections';
    
    $unique_collections = general_query("SELECT COUNT(DISTINCT(owner_flow_address)) AS collections_count FROM sportvatars;");
    
    $stats[] = array(
        'stat' => 'Collections w/ 1+ Sportvatars',
        'amount' => $unique_collections[0]['collections_count'],
        'extra' => '<a href="ranking-top-100-collections.php" class="text_link">Top 100 Collections</a>'
    );
    
    $unopened_packs = general_query("SELECT SUM(packs) AS packs_count FROM collections;");
    
    $stats[] = array(
        'stat' => 'Held Unopened Packs',
        'amount' => $unopened_packs[0]['packs_count'],
        'extra' => '<a href="ranking-top-100-collections.php" class="text_link">Top 100 Collections</a>'
    );
    
    $stats[] = array(
        'stat' => 'Average Sportvatars per Collection',
        'amount' => ceil($num_sportvatars / $unique_collections[0]['collections_count']),
        'extra' => '<a href="ranking-top-100-collections.php" class="text_link">Top 100 Collections</a>'
    );
    
    $stats[] = 'Marketplace';
    
    $market_stats_official = curl_request_contents('https://sportvatar.com/api/marketplace/stats');
    $market_stats_official = json_decode($market_stats_official, true);

    $stats[] = array(
        'stat' => 'Total Sales',
        'amount' => '$'. number_format($market_stats_official['total'], 2),
        'extra' => '<a href="https://sportvatar.com/marketplace" target="_blank" class="text_link">Marketplace</a>'
    );
    
    $stats[] = array(
        'stat' => 'Average Sale',
        'amount' => '$'. number_format($market_stats_official['avg'], 2),
        'extra' => '<a href="https://sportvatar.com/marketplace" target="_blank" class="text_link">Marketplace</a>'
    );
    
    $stats[] = array(
        'stat' => 'Number of Sales',
        'amount' => number_format($market_stats_official['count'], 2)+0,
        'extra' => '<a href="https://sportvatar.com/marketplace" target="_blank" class="text_link">Marketplace</a>'
    );
    
    $stats[] = array(
        'stat' => 'Highest Sale',
        'amount' => '$'. number_format($market_stats_official['max'], 2),
        'extra' => '<a href="https://sportvatar.com/marketplace" target="_blank" class="text_link">Marketplace</a>'
    );
    
    $sportvatars_on_sale = search_marketplace(array('templatecat' => 'sportvatar'));
    $stats[] = array(
        'stat' => 'Sportvatars Currently on Sale',
        'amount' => $sportvatars_on_sale['total'] . ' (' . number_format((($sportvatars_on_sale['total'] / $num_sportvatars) * 100), 2) . '%)',
        'extra' => '<a href="https://sportvatar.com/marketplace#templatecat=sportvatar" target="_blank" class="text_link">Marketplace</a>'
    );
    
    $common_sportvatars_on_sale = search_marketplace(array('templatecat' => 'sportvatar', 'rarity' => 'common'));
    $stats[] = array(
        'stat' => 'Common Sportvatars Currently on Sale',
        'amount' => $common_sportvatars_on_sale['total'] . ' of '. $num_common_sportvatars .' (' . number_format((($common_sportvatars_on_sale['total'] / $num_common_sportvatars) * 100), 2) . '%)',
        'extra' => '<a href="https://sportvatar.com/marketplace#templatecat=sportvatar&rarity=common" target="_blank" class="text_link">Commons Marketplace</a>'
    );
    
    $rare_sportvatars_on_sale = search_marketplace(array('templatecat' => 'sportvatar', 'rarity' => 'rare'));
    $stats[] = array(
        'stat' => 'Rare Sportvatars Currently on Sale',
        'amount' => $rare_sportvatars_on_sale['total'] . ' of '. $num_rare_sportvatars .' (' . number_format((($rare_sportvatars_on_sale['total'] / $num_rare_sportvatars) * 100), 2) . '%)',
        'extra' => '<a href="https://sportvatar.com/marketplace#templatecat=sportvatar&rarity=rare" target="_blank" class="text_link">Rares Marketplace</a>'
    );
    
    $epic_sportvatars_on_sale = search_marketplace(array('templatecat' => 'sportvatar', 'rarity' => 'epic'));
    $stats[] = array(
        'stat' => 'Epic Sportvatars Currently on Sale',
        'amount' => $epic_sportvatars_on_sale['total'] . ' of '. $num_epic_sportvatars .' (' . number_format((($epic_sportvatars_on_sale['total'] / $num_epic_sportvatars) * 100), 2) . '%)',
        'extra' => '<a href="https://sportvatar.com/marketplace#templatecat=sportvatar&rarity=epic" target="_blank" class="text_link">Epics Marketplace</a>'
    );
    
    $legendary_sportvatars_on_sale = search_marketplace(array('templatecat' => 'sportvatar', 'rarity' => 'legendary'));
    $stats[] = array(
        'stat' => 'Legendary Sportvatars Currently on Sale',
        'amount' => $legendary_sportvatars_on_sale['total'] . ' of '. $num_legendary_sportvatars .' (' . number_format((($legendary_sportvatars_on_sale['total'] / $num_legendary_sportvatars) * 100), 2) . '%)',
        'extra' => '<a href="https://sportvatar.com/marketplace#templatecat=sportvatar&rarity=legendary" target="_blank" class="text_link">Legendaries Marketplace</a>'
    );
    
    return $stats;
}