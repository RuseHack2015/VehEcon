<?php
/**
 * Created by PhpStorm.
 * User: Pavel Zlatarov
 * Date: 29.5.2015 г.
 * Time: 22:04
 */

class User extends CI_Model {

    private $id = null;
    private $username = null;
    private $email = null;

    public function __construct(){
        parent::__construct();
        $this->load->helper('general');
    }

    public function setID($id){
        $this->id = $id;
    }

    public function getID(){
        return $this->id;
    }

    public function update(){
        $query = $this->db->query('SELECT * FROM '.$this->db->dbprefix('users').' WHERE id = ?',array($this->id));
        if($query){
            if($query->num_rows() == 1){
                $this->username = $query->row(0)->username;
                $this->email = $query->row(0)->email;
                return true;
            }
        }
        return false;
    }

    public function auth($username,$password){
        $passkey = sha1($username.'.'.sha1($password));
        $query = $this->db->query('SELECT * FROM '.$this->db->dbprefix('users').' WHERE username = ? and passkey = ?',array($username,$passkey));
        if($query->num_rows() == 1){
            $this->setID($query->row(0)->id);
            $this->update();
            return true;
        }
        return false;
    }
    public function setSession($session){
        $session->set_userdata('userid',$this->id);
    }

    public function getUsername(){
        return $this->username;
    }

    public function initID($id){
        $this->id = $id;
        return $this->update();
    }

    public function newAppKey(){
        $key = random_string(64);
        $this->db->query('INSERT INTO '.$this->db->dbprefix('app_keys').' (user,appkey) VALUES (?, ?)', array($this->id,$key));
        return $key;
    }

    public function getByKey($key){
        $q =$this->db->query('SELECT * FROM '.$this->db->dbprefix('app_keys').' WHERE appkey = ?',array($key));
        if($q && $q->num_rows() == 1) {
            $id = $q->row(0)->user;
            $this->initID($id);
            return true;
        }
        return false;
    }
}