<?php

  /**
   *
   */
  class Subtopics_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }



    public function view($id){
      $fieldnames = array('st_id', 't_id', 'stName', 'stOverview');
      $condition = "st_id = $id";
      $result = $this->db->select('subtopics', $fieldnames, $condition);

      return $result;
    }

    public function getTest($key){
      $st_id = $_POST['st_id'];
      $fieldnames = array('test_id', 'testCategory', 'testName');
      $condition = ($key == '*') ? "testInTrash = 0 AND st_id = $st_id" : "testInTrash = 0 AND st_id = $st_id AND testName LIKE '%$key%'";
      $result = $this->db->select('tests', $fieldnames, $condition);


      return json_encode($result);
    }


  }
