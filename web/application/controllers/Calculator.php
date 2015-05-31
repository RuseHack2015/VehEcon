<?php
/**
 * Created by PhpStorm.
 * User: Pavel Zlatarov
 * Date: 30.5.2015 г.
 * Time: 11:03
 */

class Calculator extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('general');
        $this->load->model('User','user',true);
        $this->load->model('Car','car',true);
    }

    public function index(){

    }

    public function usecar($car){
        if(!isset($_SESSION['userid'])){
            header('Location: '.site_url());
            return;
        } else $this->user->initID($_SESSION['userid']);
        $data = array(
            'title'=>'Calculator',
            'username'=> $this->user->getUsername(),
            'userid' => $this->user->getID(),
            'prices' => get_fuel_prices(),
            'car' => null
        );
        if(!$this->car->getByID($car)){
            $data['error'] = 1;
        } else if(($this->car->getUser() != $this->user->getID()) && !$this->car->isPublic()){
            $data['error'] = 1;
        } else{
            $data['car'] = $this->car->asArray();
        }
        $this->load->view('calculator_car',$data);
    }
}