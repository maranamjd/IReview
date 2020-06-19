<?php

  /**
   *
   */
  class Topic_Model extends Model
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
      echo json_encode($result);
    }

    public function addTopic(){
      $data = array(
          't_id'  => null,
          'u_id'  => Session::get('uid'),
          'tName' => $_POST['topicTitle']
      );

      $result = $this->db->insert('topics', $data);

      if ($result == 1) {
        echo "Topic successfuly added.";
      }else {
        echo "Failed to add Topic!";
      }
    }

    public function updateTopic(){
      $data = array(
        'tName'      => $_POST['tName']
      );
      $tId = $_POST['tId'];
      $condition = "t_id = $tId";
      $result = $this->db->update("topics", $data, $condition);

      if ($result == 1) {
        echo "Topic successfuly Updated.";
      }else {
        echo "Failed to Update Topic!";
      }
    }

    public function deleteTopic(){
      $data = array(
        'tInTrash'  => 1
      );
      $tId = $_POST['tId'];
      $condition = "t_id = $tId";
      $result = $this->db->update("topics", $data, $condition);

      if ($result == 1) {
        echo "Topic moved to trash!";
      }else {
        echo "Failed to Delete Topic!";
      }
    }

    public function addSubtopic(){
      $data = array(
          'st_id'       => null,
          't_id'        => $_POST['tId'],
          'stName'       => $_POST['stName'],
          'stOverview'  => $_POST['stOverview']
      );

      $result = $this->db->insert('subtopics', $data);

      if ($result == 1) {
        echo "Sub-topic successfuly added.";
      }else {
        echo "Failed to add Sub-topic!";
      }
    }

    public function updateSubtopic(){
      $data = array(
        'stName'      => $_POST['stName'],
        'stOverview'  => $_POST['stOverview']
      );
      $stId = $_POST['stId'];
      $condition = "st_id = $stId";
      $result = $this->db->update("subtopics", $data, $condition);

      if ($result == 1) {
        echo "Sub-topic successfuly Updated.";
      }else {
        echo "Failed to Update Sub-topic!";
      }
    }

    public function deleteSubtopic(){
      $data = array(
        'stInTrash'  => 1
      );
      $stId = $_POST['stId'];
      $condition = "st_id = $stId";
      $result = $this->db->update("subtopics", $data, $condition);

      if ($result == 1) {
        echo "Sub-topic moved to trash!";
      }else {
        echo "Failed to Delete Sub-topic!";
      }
    }

    public function addSubtopicToFav(){
      $data = array(
        'stFavorite'  => 1
      );
      $stId = $_POST['stId'];
      $condition = "st_id = $stId";
      $result = $this->db->update("subtopics", $data, $condition);

      if ($result == 1) {
        echo "Sub-topic added to Favorites!";
      }else {
        echo "Failed to add Sub-topic into Favorites!";
      }
    }

    public function removeSubtopicFromFav(){
      $data = array(
        'stFavorite'  => 0
      );
      $stId = $_POST['stId'];
      $condition = "st_id = $stId";
      $result = $this->db->update("subtopics", $data, $condition);

      if ($result == 1) {
        echo "Sub-topic removed from Favorites!";
      }else {
        echo "Failed to remove Sub-topic from Favorites!";
      }
    }
  }
