<?php
/**
 * Created by PhpStorm.
 * User: Pavel Zlatarov
 * Date: 29.5.2015 г.
 * Time: 21:34
 */

class Index extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper("url");
        $this->load->helper('general');
        $this->load->config('webapi');
        $this->load->model('User','user',true);
    }

    public function index(){

        if(!isset($_SESSION['userid'])){
            $this->login();
            return;
        } else $this->user->initID($_SESSION['userid']);
        $data = array(
            'title' => 'Home',
            'username' => $this->user->getUsername(),
            'fuel_prices' => get_fuel_prices(),
            'dateformat' => $this->config->item('custom_date_format')
        );
        $this->load->view("index",$data);
    }

    public function login(){

        if($this->input->post('submit')){
            if(strlen($this->input->post('username',TRUE)) < 1 || strlen($this->input->post('userpassword',TRUE)) < 1)
                $data['error'] = 1;
            elseif(!$this->user->auth($this->input->post('username',TRUE),$this->input->post('userpassword',TRUE)))
                $data['error'] = 2;
            else{
                $_SESSION['userid'] = $this->user->getID();
                header('Location: '.site_url().'/index');
            }
        }

        $this->load->view("login");
    }

    public function logout(){
        unset($_SESSION['userid']);
        header('Location: '.site_url());
    }
}