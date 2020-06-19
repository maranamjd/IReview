<?php

  /**
   *
   */
  class Favorites_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }
    public function view($key){
      $fieldnames = array('st_id');
      $u_id = Session::get('uid');
      $condition = "u_id = $u_id";
      $result = $this->db->select('favorites', $fieldnames, $condition);

      $subtopics = array();
      foreach ($result as $value) {

        $fieldnames = array('st_id', 't_id', 'stName', 'stOverview', 'stInTrash');
        $condition = ($key == '*') ? "stInTrash = 0 AND st_id = ".$value['st_id'] : "stName LIKE '%$key%' AND stInTrash = 0 AND st_id = ".$value['st_id'];
        $result = $this->db->select('subtopics', $fieldnames, $condition);

        foreach ($result as $value) {
          $subtopics[] = $value;
        }
      }
      return json_encode($subtopics);
    }

    public function removeSubtopicFromFav(){
      $u_id       = Session::get('uid');
      $st_id      = $_POST['stId'];
      $fieldnames = array('f_id');
      $condition  = "st_id = $st_id AND u_id = $u_id";
      $result     = $this->db->select('favorites', $fieldnames, $condition)[0];

      $f_id       = $result['f_id'];
      $condition  = "f_id = $f_id";
      $result = $this->db->delete('favorites', $condition);

      return $result;
    }

  }
