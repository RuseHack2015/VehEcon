<?php
/**
 * Created by PhpStorm.
 * User: Pavel Zlatarov
 * Date: 30.5.2015 г.
 * Time: 15:58
 */

class Stations extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('general');
        $this->load->config('webapi');
        $this->load->model('User','user',true);
    }

    public function index(){

        if(!isset($_SESSION['userid'])){
            header('Location: '.site_url());
            return;
        } else $this->user->initID($_SESSION['userid']);
        $data = array(
            'title'=>'Nearest gas station(s)',
            'username'=> $this->user->getUsername(),
            'maps_api_key' => $this->config->item('maps_browserkey')
        );
        $this->load->view('stations',$data);

    }
}