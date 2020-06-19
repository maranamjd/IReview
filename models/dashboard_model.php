<?php

  /**
   *
   */
  class Dashboard_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }
    public function getData(){

      $data = array("u_id");
      $condition = "uType != 'Administrator'";
      $users = $this->db->select('users', $data, $condition);
      $result['users'] = count($users);

      $data = array("u_id");
      $condition = "uType = 'Encoder'";
      $encoders = $this->db->select('users', $data, $condition);
      $result['encoders'] = count($encoders);

      $data = array("u_id");
      $condition = "uType = 'Visitor'";
      $visitors = $this->db->select('users', $data, $condition);
      $result['visitors'] = count($visitors);

      $data = array("u_id");
      $condition = "uActive = 0";
      $inactives = $this->db->select('users', $data, $condition);
      $result['inactives'] = count($inactives);

      return json_encode($result);

    }
  }
