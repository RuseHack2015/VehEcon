<?php
/**
 * Created by PhpStorm.
 * User: Pavel Zlatarov
 * Date: 30.5.2015 г.
 * Time: 16:24
 */
require_once(APPPATH."libraries".DIRECTORY_SEPARATOR."REST_Controller.php");
class Getstations extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->config('webapi');
    }

    public function index(){
        //a bag full of nothing.
    }

    public function stations($lat=0,$lon=0,$count=1){
        $json = file_get_contents($this->config->item('url_near').'&lat='.$lat.'&lon='.$lon.'&limit='.$count);
        header('Content-type: application/json');
        echo $json;

    }
}