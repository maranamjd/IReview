<?php

  /**
   *
   */
  class Topics_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }

    public function view($key){
      $fieldnames = array('t_id', 'u_id', 'tName', 'tFavorite');
      $uId = Session::get('uid');
      $condition = ($key == '*') ? "tInTrash = 0 ORDER BY tName" : "tInTrash = 0 AND tName LIKE '%$key%' ORDER BY tName";
      $result['topic'] = $this->db->select('topics', $fieldnames, $condition);

      $fieldnames = array('st_id');
      $u_id = Session::get('uid');
      $condition = "u_id = $u_id";
      $result['favorites'] = $this->db->select('favorites', $fieldnames, $condition);

      $tids = array();
      $subtopic = array();

      foreach ($result['topic'] as $key => $value) {
        $tids[] = $value['t_id'];
      }
      foreach ($tids as $value) {
        $tId = $value;
        $fieldnames = array('st_id', 't_id', 'stName', 'stOverview');
        $condition = "stInTrash != 1 AND t_id = $tId ORDER BY stName";
        $result['subtopic'] = $this->db->select('subtopics', $fieldnames, $condition);

        foreach ($result['subtopic'] as $value) {
          $subtopic[] = $value;
        }
      }
      $result['subtopic'] = $subtopic;
      return json_encode($result);
    }

    public function addSubtopicToFav(){
      $u_id = Session::get('uid');
      $st_id = $_POST['stId'];
      $data = array(
        'f_id'   => null,
        'st_id'  => $st_id,
        'u_id'   => $u_id
      );
      $result = $this->db->insert('favorites', $data);

      return $result;
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
