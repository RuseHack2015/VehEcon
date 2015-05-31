<?php
/**
 * Created by PhpStorm.
 * User: Pavel Zlatarov
 * Date: 29.5.2015 г.
 * Time: 22:35
 */

class Car extends CI_Model {

    private $id = null;
    private $make = null;
    private $model = null;
    private $fueltype = null;
    private $consumption = null;
    private $class = null;
    private $user = null;
    private $public = false;
    private $modifier = 0;

    /**
     * @return boolean
     */
    public function isPublic()
    {
        return $this->public;
    }

    /**
     * @param boolean $public
     */
    public function setPublic($public)
    {
        $this->public = $public;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * @param null $make
     */
    public function setMake($make)
    {
        $this->make = $make;
    }

    /**
     * @return null
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param null $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return null
     */
    public function getFueltype()
    {
        return $this->fueltype;
    }

    /**
     * @param null $fueltype
     */
    public function setFueltype($fueltype)
    {
        $this->fueltype = $fueltype;
    }

    /**
     * @return null
     */
    public function getConsumption()
    {
        return $this->consumption;
    }

    /**
     * @param null $consumption
     */
    public function setConsumption($consumption)
    {
        $this->consumption = $consumption;
    }

    /**
     * @return null
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param null $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return int
     */
    public function getModifier()
    {
        return $this->modifier;
    }

    /**
     * @param int $modifier
     */
    public function setModifier($modifier)
    {
        $this->modifier = $modifier;
    }

    public function __construct(){
        parent::__construct();
    }

    public function insert(){
        $query = $this->db->query('INSERT INTO '.$this->db->dbprefix('cars').' (make, model, fueltype, consumption, class, user, public) VALUES (?, ?, ?, ?, ?, ?, ?)',array($this->make,$this->model,$this->fueltype,$this->consumption,$this->class,$this->user,$this->public));
        if($query) return true;
        return false;
    }

    /**
     * @return null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param null $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    public function resetModifier(){
        $this->modifier = 0;
    }

    public function increaseModifier($value){
        $this->modifier += $value;
    }

    public function decreaseModifier($value){

    }

    public function getByID($id){
        $query = $this->db->query('SELECT * FROM '.$this->db->dbprefix('cars').' WHERE id = ?',array($id));
        if($query->num_rows() != 1) return false;
        $row = $query->row(0);
        $this->make = $row->make;
        $this->model = $row->model;
        $this->fueltype = $row->fueltype;
        $this->consumption = $row->consumption;
        $this->class = $row->class;
        $this->user = $row->user;
        $this->public = $row->public;
        return true;
    }

    public function getAllByUser($user){
        $query = $this->db->query('SELECT * FROM '.$this->db->dbprefix('cars').' WHERE user = ?', array($user));
        if($query->num_rows() < 1 )  return null;
        else return $query->result_array();
    }

    public function asArray(){
        $data = array(
            'id' => $this->id,
            'make' => $this->make,
            'model' => $this->model,
            'fueltype' => $this->fueltype,
            'consumption' => $this->consumption,
            'class' => $this->class,
            'user' => $this->user,
            'public' => $this->public
        );

        return $data;
    }


}