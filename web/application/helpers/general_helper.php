<?php
/**
 * Created by PhpStorm.
 * User: Pavel Zlatarov
 * Date: 30.5.2015 г.
 * Time: 8:03
 */

if(!function_exists('get_fuel_prices')){
    //This function implements price caching to speed up loading time. It gets prices from the API every 24 hours.
    function get_fuel_prices(){
        $ci = get_instance();
        $ci->load->config('webapi');
        $query = $ci->db->query('SELECT gasoline,diesel,lpg,methane,timestamp FROM '.$ci->db->dbprefix('price_cache').' WHERE timestamp > ? ORDER BY id DESC',array(time()-$ci->config->item('cache_time')));
        if($query->num_rows() < 1){
            $a = get_fuel_prices_api();
            $ci->db->query('INSERT INTO '.$ci->db->dbprefix('price_cache'). ' (timestamp,gasoline,diesel,lpg,methane) VALUES (?,?,?,?,?)', array(time(),$a['gasoline'],$a['diesel'],$a['lpg'],$a['methane']));
            return $a;
        } else{
            return $query->row_array(0);
        }
    }
}



if (!function_exists('get_fuel_prices_api')){
    function get_fuel_prices_api(){
        $ci = get_instance();
        $ci->load->config('webapi');
        $data = array(
            'gasoline' => 0.0,
            'diesel' => 0.0,
            'lpg' => 0.0,
            'methane' => 0.0,
            'timestamp' => 0
        );
        $data['gasoline'] = floatval(json_decode(file_get_contents($ci->config->item('url_gasoline')))->price);
        $data['diesel'] = floatval(json_decode(file_get_contents($ci->config->item('url_diesel')))->price);
        $data['lpg'] = floatval(json_decode(file_get_contents($ci->config->item('url_lpg')))->price);
        $data['methane'] = floatval(json_decode(file_get_contents($ci->config->item('url_methane')))->price);
        $data['timestamp'] = time();

        return $data;
    }
}

if(!function_exists('get_car_class')){
    function get_car_class($num){
        switch($num){
            case 1:
                return 'Passenger car';
            break;

            case 2:
                return 'Pickup';
            break;

            case 3:
                return "Commercial vehicle";
            break;

            case 4:
                return "Freight vehicle";
            break;
        }
    }
}

if(!function_exists('random_string')){
    function random_string($length = 10){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}