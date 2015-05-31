<?php
/**
 * Created by PhpStorm.
 * User: Pavel Zlatarov
 * Date: 31.5.2015 г.
 * Time: 6:55
 */
require_once(APPPATH."libraries".DIRECTORY_SEPARATOR."REST_Controller.php");
class Login extends REST_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('general');
        $this->load->model('User','user',true);
        $this->load->model('Car','car',true);
    }

    public function index_get(){

    }

    public function index_post(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if($this->user->auth($username,$password)){
            $this->response(array(
                "status"=>"200",
                "key" => $this->user->newAppKey()
            ),200);
        } else{
            $this->response(array("status"=>"401"),200);
        }
    }

    public function getinfo_get($key=""){
        if(strlen($key)< 1){
            $this->response(array("status"=>"500"),200);
            return;
        }
        if($this->user->getByKey($key)){
            $response = array(
                "status" => "200",
                "userid" => $this->user->getID(),
                "username" => $this->user->getUsername(),
                "cars" => ($this->car->getAllByUser($this->user->getID())==null?array():$this->car->getAllByUser($this->user->getID()))
            );
            $this->response($response,200);
        } else{
            $this->response(array("status"=>"401"),200);
        }
    }
}