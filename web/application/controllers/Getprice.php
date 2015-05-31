<?php
/**
 * Created by PhpStorm.
 * User: Pavel Zlatarov
 * Date: 29.5.2015 г.
 * Time: 20:02
 */
define('APIKEY', "babcfc32e97eaf4");
define('URL',"http://fuelo.net/api/price?key=".APIKEY);
require_once(APPPATH."libraries".DIRECTORY_SEPARATOR."REST_Controller.php");
class Getprice extends REST_Controller{

    public function index_get(){
        $data = array("gas"=>"","diesel"=>"","lpg"=>"","methane"=>"");
        $data['gas'] = floatval(json_decode(file_get_contents(URL.'&fuel=gasoline'))->price);
        $data['diesel'] = json_decode(file_get_contents(URL.'&fuel=diesel'))->price;
        $data['lpg'] = json_decode(file_get_contents(URL.'&fuel=lpg'))->price;
        $data['methane'] = json_decode(file_get_contents(URL.'&fuel=methane'))->price;
        $this->response($data);
    }

    public function index_post(){
        //echo "Hello world post";
    }
}