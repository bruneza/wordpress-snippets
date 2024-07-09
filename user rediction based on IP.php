<?php 

function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } else if (isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }
    return $ipaddress;
}

function gura_country_redirect()
{
    $PublicIP = get_client_ip();
    $location_json = file_get_contents("https://ipinfo.io/$PublicIP/geo") ?? null;
    $location_json = json_decode($location_json, true);
    $country = (isset($location_json)) ? $location_json['country'] : 'Unknown';

    if ($country === 'RW') {
        wp_redirect(home_url('/rwanda') .$_SERVER['REQUEST_URI']);
        exit;
    }
}

if (strpos($_SERVER['REQUEST_URI'], '/rwanda') === false && !current_user_can('manage_options') ) {
add_action('template_redirect', 'gura_country_redirect');
}
