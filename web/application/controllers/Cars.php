<?php
/**
 * Created by PhpStorm.
 * User: Pavel Zlatarov
 * Date: 29.5.2015 г.
 * Time: 22:59
 */

class Cars extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('general');
        $this->load->model('User','user',true);
        $this->load->model('Car','car',true);
        $this->load->database();
    }

    public function index(){
        if(!isset($_SESSION['userid'])){
            header('Location: '.site_url());
            return;
        } else $this->user->initID($_SESSION['userid']);
        $data = array(
            'title'=>'Cars',
            'username'=> $this->user->getUsername(),
            'cars' => $this->car->getAllByUser($this->user->getID())
        );
        $this->load->view('cars',$data);
    }

    public function add(){
        if(!isset($_SESSION['userid'])){
            header('Location: '.site_url());
            return;
        } else $this->user->initID($_SESSION['userid']);
        $data = array(
            'title'=>'Add a car',
            'username'=> $this->user->getUsername(),
        );
        if($this->input->post('submit')){
            $data['insertSuccess'] = false;
            //TODO error & security checks
            if(strlen($this->input->post('car_make')) < 1 || strlen($this->input->post('car_model')) < 1){
                $data['insertSuccess'] = false;
            } else {
                $this->car->setMake($this->input->post('car_make'));
                $this->car->setModel($this->input->post('car_model'));
                $this->car->setFueltype($this->input->post('car_fueltype'));
                $this->car->setConsumption(floatval($this->input->post('car_consumption')));
                $this->car->setClass($this->input->post('car_class'));
                $this->car->setUser($this->user->getID());
                $this->car->setPublic($this->input->post('car_public'));
                if ($this->car->insert()) {
                    $data['insertSuccess'] = true;
                }
            }
        }
        $this->load->view('cars/add',$data);
    }

    public function delete($id){
        if(!isset($_SESSION['userid'])){
            header('Location: '.site_url());
            return;
        } else $this->user->initID($_SESSION['userid']);

        $query = $this->db->query('DELETE FROM '.$this->db->dbprefix('cars').' WHERE id = ? AND user = ?',array($id, $this->user->getID()));
        if($query){
            header('Location: '.site_url('/cars?deleted=1'));
        }
        else{
            header('Location: '.site_url('/cars?=delerror=1'));
        }
    }
}