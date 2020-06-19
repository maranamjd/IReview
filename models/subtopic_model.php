<?php

  /**
   *
   */
  class Subtopic_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }

    public function deleteQuestion(){
      $data = array(
        'qInTrash'  => 1
      );
      $q_id = $_POST['q_id'];
      $condition = "q_id = $q_id";
      $result = $this->db->update("questions", $data, $condition);

      if ($result == 1) {
        return "Question moved to trash!";
      }else {
        return "Failed to Delete question!";
      }
    }
    public function updateQuestion(){

      $data = array(
        'qDescription'  => $_POST['qDescription']
      );
      $q_id = $_POST['q_id'];
      $condition = "q_id = $q_id";
      $result = $this->db->update("questions", $data, $condition);


      switch ($_POST['qCategory']) {
        case 'multiplechoiceForm':
        for ($i=1; $i <= 4 ; $i++) {
          $answer = 0;
          if ($_POST['answer'] == 'choice'.$i) {
            $answer = 1;
          }
          $data = array(
            'mccDescription'  => implode(" ", explode("%20", $_POST['choice'.$i])),
            'mccIsAnswer'     => $answer
          );
          $condition = "mcc_id = ".$_POST['choice'.$i.'id'];
          $result = $this->db->update('mc_choices', $data, $condition);
        }
          break;

        case 'truefalseForm':
          $data = array(
            'tfaDescription'  => $_POST['answer']
          );
          $condition = "tfa_id = ".$_POST['tfqid'];
          $result = $this->db->update('tf_answers', $data, $condition);
          break;

        case 'enumerationForm':
          for ($i=1; $i <= $_POST['enumerationCount']; $i++) {
            $data = array(
              'eaDescription'  => implode(" ", explode("%20", $_POST['answer'.$i]))
            );
            $condition = "ea_id = ".$_POST['answer'.$i.'id'];
            $result = $this->db->update('e_answers', $data, $condition);
          }
          break;
      }


      if ($result == 1) {
        return "Question successfuly updated!";
      }else {
        return "Failed to update question!";
      }
    }

    public function addQuestion(){
      $data = array(
        'q_id'          => null,
        'test_id'       => $_POST['test_id'],
        'qDescription'  => $_POST['qDescription']
      );
      $result = $this->db->insert('questions', $data);
      $lastInsertQuestionId = $this->db->lastInsertId();
      if ($result) {
        switch ($_POST['qCategory']) {
          case 'enumerationForm':
          for ($i=1; $i <= $_POST['enumerationCount']; $i++) {
            $data = array(
              'ea_id'          => null,
              'q_id'           => $lastInsertQuestionId,
              'eaDescription'  => implode(" ", explode("%20", $_POST['answer'.$i]))
            );
            $result = $this->db->insert('e_answers', $data);
          }
          break;

          case 'truefalseForm':
            $data = array(
              'tfa_id'          => null,
              'q_id'            => $lastInsertQuestionId,
              'tfaDescription'  => $_POST['answer']
            );
            $result = $this->db->insert('tf_answers', $data);
          break;

          case 'multiplechoiceForm':
          for ($i=1; $i <= 4 ; $i++) {
            $answer = 0;
            if ($_POST['answer'] == 'choice'.$i) {
              $answer = 1;
            }
            $data = array(
              'mcc_id'          => null,
              'q_id'            => $lastInsertQuestionId,
              'mccDescription'  => implode(" ", explode("%20", $_POST['choice'.$i])),
              'mccIsAnswer'     => $answer
            );
            $result = $this->db->insert('mc_choices', $data);
          }
          break;
        }
        return "Question added successfuly!";
      }else {
        return "Failed to add Question!";
      }
    }



    public function view($id){
      $fieldnames = array('st_id', 't_id', 'stName', 'stOverview');
      $condition = "st_id = $id AND stInTrash = 0";
      $result = $this->db->select('subtopics', $fieldnames, $condition);

      return $result;
    }
    public function getTest($key){
      $st_id = $_POST['st_id'];
      $fieldnames = array('test_id', 'testCategory', 'testName');
      $condition = ($key == '*') ? "testInTrash = 0 AND st_id = $st_id" : "testInTrash = 0 AND st_id = $st_id AND testName LIKE '%$key%'";
      $tests = $this->db->select('tests', $fieldnames, $condition);
      $result['tests'] = $tests;

      foreach ($tests as $value) {
        if ($value['testCategory'] == "Multiple Choice") {

          $fieldnames = array('q_id, test_id, qDescription, qDifficulty');
          $condition = "qIntrash = 0 AND test_id = ". $value['test_id'];
          $questions = $this->db->select('questions', $fieldnames, $condition);

          foreach ($questions as $value) {
            $fieldnames = array('mcc_id, q_id, mccDescription, mccIsAnswer');
            $condition = "q_id = ". $value['q_id'];
            $choices['mc'] = $this->db->select('mc_choices', $fieldnames, $condition);
            $result['questions'][] = $value;
            foreach ($choices['mc'] as $value) {
              $result['choices'][] = $value;
            }
          }

        }elseif ($value['testCategory'] == "True or False") {

          $fieldnames = array('q_id, test_id, qDescription, qDifficulty');
          $condition = "qIntrash = 0 AND test_id = ". $value['test_id'];
          $questions = $this->db->select('questions', $fieldnames, $condition);

          foreach ($questions as $value) {
            $fieldnames = array('tfa_id, q_id, tfaDescription');
            $condition = "q_id = ". $value['q_id'];
            $choices['tf'] = $this->db->select('tf_answers', $fieldnames, $condition);
            $result['questions'][] = $value;
            foreach ($choices['tf'] as $value) {
              $result['choices'][] = $value;
            }
          }

        }elseif ($value['testCategory'] == "Enumeration") {

          $fieldnames = array('q_id, test_id, qDescription, qDifficulty');
          $condition = "qIntrash = 0 AND test_id = ". $value['test_id'];
          $questions = $this->db->select('questions', $fieldnames, $condition);

          foreach ($questions as $value) {
            $fieldnames = array('ea_id, q_id, eaDescription');
            $condition = "q_id = ". $value['q_id'];
            $choices['en'] = $this->db->select('e_answers', $fieldnames, $condition);
            $result['questions'][] = $value;
            foreach ($choices['en'] as $value) {
              $result['choices'][] = $value;
            }
          }

        }
      }
      return json_encode($result);
    }

    public function addTest(){
      $data = array(
          'test_id'      => null,
          'st_id'        => $_POST['st_id'],
          'testName'     => $_POST['testName'],
          'testCategory' => $_POST['testCategory']
      );

      $result = $this->db->insert('tests', $data);

      if ($result == 1) {
        return "Test successfuly added.";
      }else {
        return "Failed to add Test!";
      }
    }

    public function deleteTest(){
      $data = array(
        'testInTrash'  => 1
      );
      $test_id = $_POST['test_id'];
      $condition = "test_id = $test_id";
      $result = $this->db->update("tests", $data, $condition);

      if ($result == 1) {
        return "Test moved to trash!";
      }else {
        return "Failed to Delete Test!";
      }
    }
    public function updateTest(){
      $data = array(
        'testName'  => $_POST['testName']
      );
      $test_id = $_POST['test_id'];
      $condition = "test_id = $test_id";
      $result = $this->db->update("tests", $data, $condition);

      if ($result == 1) {
        return "Test successfuly updated!";
      }else {
        return "Failed to update Test!";
      }
    }



  }
