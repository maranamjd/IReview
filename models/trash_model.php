<?php

  /**
   *
   */
  class Trash_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }

    public function subtopic($key){
      $fieldnames = array('t_id');
      $uId = Session::get('uid');
      $condition = "tInTrash = 0";
      $result = $this->db->select('topics', $fieldnames, $condition);

      $subtopics = array();
      foreach ($result as $value) {
        $fieldnames = array('st_id', 't_id', 'stName', 'stOverview', 'stInTrash');
        $condition = ($key == '*') ? "stInTrash = 1 AND t_id = ".$value['t_id'] : "stName LIKE '%$key%' AND stInTrash = 1 AND t_id = ".$value['t_id'];
        $result = $this->db->select('subtopics', $fieldnames, $condition);

        foreach ($result as $value) {
          $subtopics[] = $value;
        }
      }
      return json_encode($subtopics);
    }

    public function restoreSubTopic(){
      $stId = $_POST['stId'];
      $data = array(
        'stInTrash' => 0
      );
      $condition = "st_id = $stId";
      $result = $this->db->update('subtopics', $data, $condition);

      if ($result == 1) {
        return "Sub-topic Restored from Trash!";
      }else {
        return "Failed to restore Sub-topic from Trash!";
      }
    }

    public function deleteSubTopic(){
      $stId = $_POST['stId'];
      $condition = "st_id = $stId";
      $result = $this->db->delete('subtopics', $condition);

      if ($result == 1) {
        return "Sub-topic deleted permanently.";
      }else {
        return "Failed to delete sub-topic!";
      }
    }

    public function topic($key){
    $uId = Session::get('uid');
    $fieldnames = array('t_id', 'tName');
    $condition = ($key == '*') ? "tInTrash = 1" : "tName LIKE '%$key%' AND tInTrash = 1";
    $result = $this->db->select('topics', $fieldnames, $condition);

      return json_encode($result);
    }

    public function restoreTopic(){
      $tId = $_POST['tId'];
      $data = array(
        'tInTrash' => 0
      );
      $condition = "t_id = $tId";
      $result = $this->db->update('topics', $data, $condition);

      if ($result == 1) {
        return "Topic Restored from Trash!";
      }else {
        return "Failed to restore topic from Trash!";
      }
    }

    public function deleteTopic(){
      $tId = $_POST['tId'];
      $condition = "t_id = $tId";
      $result = $this->db->delete('topics', $condition);

      if ($result == 1) {
        return "Topic deleted permanently.";
      }else {
        return "Failed to delete topic!";
      }
    }


    public function test($key){
      $fieldnames = array('t_id');
      $uId = Session::get('uid');
      $condition = "tInTrash = 0";
      $result = $this->db->select('topics', $fieldnames, $condition);

      $subtopics = array();
      $tests = array();
      foreach ($result as $value) {
        $fieldnames = array('st_id', 'stName');
        $condition =  "t_id = ".$value['t_id'];
        $result = $this->db->select('subtopics', $fieldnames, $condition);

        foreach ($result as $value) {
          $subtopics[] = $value;
        }
      }
      foreach ($subtopics as $value) {
        $fieldnames = array('test_id', 'testName', 'testCategory');
        $condition = ($key == '*') ? "testInTrash = 1 AND st_id = ".$value['st_id'] : "testName LIKE '%$key%' AND testInTrash = 1 AND st_id = ".$value['st_id'];
        $result = $this->db->select('tests', $fieldnames, $condition);

        if (sizeof($result) != 0) {
          foreach ($result as $testkey => $testvalue) {
            $result[$testkey]['stName'] = $value['stName'];
          }
          $tests[$value['stName']] = $result;
        }
      }
      echo json_encode($tests);
    }

    public function restoreTest(){
      $testId = $_POST['testId'];
      $data = array(
        'testInTrash' => 0
      );
      $condition = "test_id = $testId";
      $result = $this->db->update('tests', $data, $condition);

      if ($result == 1) {
        return "Test Restored from Trash!";
      }else {
        return "Failed to restore test from Trash!";
      }
    }

    public function deleteTest(){
      $testId = $_POST['testId'];
      $condition = "test_id = $testId";
      $result = $this->db->delete('tests', $condition);

      if ($result == 1) {
        return "Test deleted permanently.";
      }else {
        return "Failed to delete test!";
      }
    }

  }
