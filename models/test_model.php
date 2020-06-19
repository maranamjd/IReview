<?php

  /**
   *
   */
  class Test_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }

    public function progress($id){
      $fieldnames = array('test_id', 'st_id', 'testName', 'testCategory');
      $condition = "test_id = $id AND testInTrash = 0";
      $result = $this->db->select('tests', $fieldnames, $condition);

      return $result;
    }

    public function export($id){
      $pdf = new FPDF('L');
      $test_id = $id;
      $u_id = Session::get('uid');
      function grade($x, $y, $pdf){
        $percentage = round(($x / $y) * 100);
      	 $pdf->SetFillColor(0,255,0);
        if($percentage >= 97 && $percentage <= 100)
          $grade = "1.00 P";
        else if($percentage >= 94 && $percentage <= 96)
          $grade = "1.25 P";
        else if($percentage >= 91 && $percentage <= 93)
          $grade = "1.50 P";
        else if($percentage >= 88 && $percentage <= 90)
          $grade = "1.75 P";
        else if($percentage >= 85 && $percentage <= 87)
          $grade = "2.00 P";
        else if($percentage >= 82 && $percentage <= 84)
          $grade = "2.25 P";
        else if($percentage >= 79 && $percentage <= 81)
          $grade = "2.50 P";
        else if($percentage >= 76 && $percentage <= 78)
          $grade = "2.75 P";
        else if($percentage == 75)
          $grade = "3.00 P";
        else if($percentage >= 65 && $percentage <= 74){
      	   $pdf->SetFillColor(255,224,128);
          $grade = "4.00 F";
        }
        else{
      	   $pdf->SetFillColor(255,0,0);
          $grade = "5.00 F";
        }
        return $grade;
      }

      $fieldnames = array("uFirstName, uMiddleName, uLastName, dateTimeAdded");
      $condition  = "u_id = $u_id";
      $user       = $this->db->select('users', $fieldnames, $condition)[0];
      $userName   = $user['uFirstName']." ".ucfirst($user['uMiddleName'][0]).". ".$user['uLastName'];
      $userId     = explode("-", explode(' ', $user['dateTimeAdded'])[0]);
      $uID        = $userId[0].$userId[1].$userId[2].'-IRV-'.$u_id;

      $fieldnames = array("testName, testCategory");
      $condition  = "test_id = $test_id";
      $test       = $this->db->select('tests', $fieldnames, $condition)[0];

      $fieldnames = array("*");
      $condition  = "test_id = $test_id AND u_id = $u_id";
      $result     = $this->db->select('results', $fieldnames, $condition);

      $testData   = array();
      $data       = array();
      foreach ($result as $value) {
        $testData['correct'] = $value['rScore'];
        $testData['wrong'] = $value['rTotalItems'] - $value['rScore'];
        $testData['date'] = date_format(date_create(explode(" ", $value['rDateTaken'])[0]), 'F d, Y');
        $data[] = $testData;
      }

      $pdf->AddPage();
      $pdf->SetLeftMargin(35);
      $pdf->SetTopMargin(35);
      $pdf->SetRightMargin(35);
      $pdf->AddFont('Calibri','','Calibri.php');
      $pdf->AddFont('Calibri Bold','','Calibri Bold.php');
      $pdf->SetY(20);
      $pdf->SetFont('Calibri Bold','',18);
      $pdf->Cell(0, 8, $test['testName'], 0, 1, 'C', false);
      $pdf->SetFont('Calibri','',14);
      $pdf->Cell(0, 8, $test['testCategory'], 0, 1, 'C', false);
      $pdf->Image(URL.'public/img/ireview4.png', 30, 5, 60);
      $pdf->Cell(0,8,'',"B",1,'C',false);
      $pdf->SetY(50);
      $pdf->Cell(20, 8, "Name:", 0, 0, 'L', false);
      $pdf->Cell(55, 8, $userName, 0, 1, 'L', false);
      $pdf->Cell(20, 8, "User ID:", 0, 0, 'L', false);
      $pdf->Cell(55, 8, $uID, 0, 1, 'L', false);
      $pdf->Cell(20, 8, "Date:", 0, 0, 'L', false);
      $pdf->Cell(55, 8, date('F d, Y'), 0, 1, 'L', false);
      $pdf->setY(80);
      $pdf->Cell(45, 8, "DATE", 1, 0, 'C', false);
      $pdf->Cell(45, 8, "Total Items", 1, 0, 'C', false);
      $pdf->Cell(45, 8, "Correct", 1, 0, 'C', false);
      $pdf->Cell(45, 8, "Wrong", 1, 0, 'C', false);
      $pdf->Cell(45, 8, "Grade", 1, 1, 'C', false);
      $pdf->SetFont('Calibri','',12);
      $i = 0;
      foreach ($data as $key => $result) {
        if($i%2 == 1){
          $fill = true;
        }else {
          $fill = false;
        }
        $pdf->Cell(45, 8, $result['date'], 1, 0, 'L', $fill);
        $pdf->Cell(45, 8, $result['correct'] + $result['wrong'], 1, 0, 'C', $fill);
        $pdf->Cell(45, 8, $result['correct'], 1, 0, 'C', $fill);
        $pdf->Cell(45, 8, $result['wrong'], 1, 0, 'C', $fill);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Calibri Bold','',12);
        $pdf->Cell(45, 8, grade($result['correct'], $result['correct']+$result['wrong'], $pdf), 1, 1, 'C', true);
        $pdf->SetFillColor(238,238,238);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Calibri','',12);
        $i++;
      }

      $pdf->Output('I');

    }

    public function data($id){
      $u_id = Session::get('uid');

      $fieldnames = array('test_id', 'st_id', 'testName', 'testCategory');
      $condition = "test_id = $id AND testInTrash = 0";
      $result['test'] = $this->db->select('tests', $fieldnames, $condition)[0];
      if ($result['test']['testCategory'] == 'Enumeration') {
        $catCode = "EN";
      }elseif ($result['test']['testCategory'] == 'True or False') {
        $catCode = "TF";
      }else {
        $catCode = "MC";
      }

      $fieldnames = array('*');
      $condition = "test_id = $id AND u_id = $u_id";
      $results = $this->db->select('results', $fieldnames, $condition);
      $newResult = array();
      foreach ($results as $value) {
        if ($value['r_id'] < 10 && $value['r_id'] > 0) {
          $rCode = "-00";
        }elseif ($value['r_id'] < 100 && $value['r_id'] > 9) {
          $rCode = "-0";
        }else {
          $rCode = "-";
        }

        $percentage = round(($value['rScore'] / $value['rTotalItems']) * 100);
        if($percentage >= 97 && $percentage <= 100)
          $grade = "<span class='btn-small green'>1.00 P</span>";
        else if($percentage >= 94 && $percentage <= 96)
          $grade = "<span class='btn-small green'>1.25 P</span>";
        else if($percentage >= 91 && $percentage <= 93)
          $grade = "<span class='btn-small green'>1.50 P</span>";
        else if($percentage >= 88 && $percentage <= 90)
          $grade = "<span class='btn-small green'>1.75 P</span>";
        else if($percentage >= 85 && $percentage <= 87)
          $grade = "<span class='btn-small green'>2.00 P</span>";
        else if($percentage >= 82 && $percentage <= 84)
          $grade = "<span class='btn-small green'>2.25 P</span>";
        else if($percentage >= 79 && $percentage <= 81)
          $grade = "<span class='btn-small green'>2.50 P</span>";
        else if($percentage >= 76 && $percentage <= 78)
          $grade = "<span class='btn-small green'>2.75 P</span>";
        else if($percentage == 75)
          $grade = "<span class='btn-small green'>3.00 P</span>";
        else if($percentage >= 65 && $percentage <= 74){
          $grade = "<span class='btn-small orange'>4.00 F</span>";
        }
        else{
          $grade = "<span class='btn-small red'>5.00 F</span>";
        }

        $newResult['testId']    = "T-".$value['test_id']."U".$value['u_id'].$catCode.$rCode.$value['r_id'];
        $newResult['testDate']  = date_format(date_create(explode(" ", $value['rDateTaken'])[0]), 'M d, Y');
        $newResult['grade']     = $grade;
        $newResult['r_id']      = $value['r_id'];
        $newResult['totalItems'] = $value['rTotalItems'];
        $newResult['score']     = $value['rScore'];
        $newResult['wrong']     = $value['rTotalItems'] - $value['rScore'];
        $result['results'][]    = $newResult;
      }

      return $result;
    }

    public function testProgress(){
      //get past test results
      $test_id = $_POST['test_id'];
      $u_id = Session::get('uid');
      $fieldnames = array("*");
      $condition  = "test_id = $test_id AND u_id = $u_id";
      $result     = $this->db->select('results', $fieldnames, $condition);
      $testData   = array();
      foreach ($result as $value) {
        $testData['correct'][] = $value['rScore'];
        $testData['wrong'][] = $value['rTotalItems'] - $value['rScore'];
        $testData['dates'][] = date_format(date_create(explode(" ", $value['rDateTaken'])[0]), 'M d');
      }

      return json_encode($testData);
    }

    public function has(){
      $u_id = Session::get('uid');
      $test_id = $_POST['test_id'];

      $fieldnames = array("COUNT(q_id) as 'q_id'");
      $condition = "test_id = $test_id";
      $qCount = $this->db->select('questions', $fieldnames, $condition)[0];
      if ($qCount['q_id'] < 5) {
        return 2;
      }else {

        $fieldnames = array("rDateTaken");
        $condition = "test_id = $test_id AND u_id = $u_id";
        $result = $this->db->select('results', $fieldnames, $condition);
        if (count($result) > 0) {
          $has = 0;
          foreach ($result as $value) {
            $date = explode(" ", $value['rDateTaken'])[0];
            if ($date == date('Y-m-d')) {
              $has = 1;
              break;
            }
          }
          if ($has == 1) {
            return 1;
          }else {
            return 0;
          }
        }else {
          return 0;
        }

      }


    }


    public function view($key){
      $fieldnames = array('test_id', 'st_id', 'testName', 'testCategory');
      $condition = "test_id = $key AND testInTrash = 0";
      $result = $this->db->select('tests', $fieldnames, $condition);

      return $result;
    }

    public function take($id){
      $test_id = $id;
      $fieldnames = array('test_id', 'testCategory', 'testName');
      $condition = "test_id = $test_id";
      $result = $this->db->select('tests', $fieldnames, $condition);

      return $result[0];
    }

    public function get(){
      $test_id              = $_POST['test_id'];
      $test_category        = $_POST['test_category'];
      $fieldnames           = array('q_id', 'qDescription', 'qDifficulty');
      $condition            = "test_id = $test_id AND qInTrash = 0";
      $result['questions']  = $this->db->select('questions', $fieldnames, $condition);


      foreach ($result['questions'] as $value) {
        $q_id = $value['q_id'];

        switch ($test_category) {
          case 'Multiple Choice':
            //multiple choice
            $fieldnames          = array('*');
            $condition           = "q_id = $q_id";
            $result['choices'][] = $this->db->select('mc_choices', $fieldnames, $condition);
            break;
          case 'True or False':
            //true or false
            $fieldnames            = array('*');
            $condition             = "q_id = $q_id";
            $result['tfAnswers'][] = $this->db->select('tf_answers', $fieldnames, $condition)[0];
            break;
          case 'Enumeration':
            //enumeration
            $fieldnames             = array('eaDescription');
            $condition              = "q_id = $q_id";
            $eAnswers               = $this->db->select('e_answers', $fieldnames, $condition);
            $fieldnames             = array("COUNT(ea_id) as 'eAnswerCount'", "q_id");
            $condition              = "q_id = $q_id";
            $eInfo                  = $this->db->select('e_answers', $fieldnames, $condition)[0];
            $data['ans']            = $eAnswers;
            $data['info']           = $eInfo;
            if (count($eAnswers > 0)) {
              $result['eAnswers'][] = $data;
            }
            break;

        }


      }


      echo json_encode($result);
      die;
    }

    public function prepare(){

      $u_id         = Session::get('uid');
      $date         = date('Y-d-m');

      if ($_POST['testCategory'] == 'Enumeration') {
        $testAnswers  = $_POST['testAnswers'];
        $test_id      = $_POST['testId'];
        $totalItems   = $_POST['eItemCount'];
        $score        = $_POST['eCorrectCount'];

        foreach ($testAnswers as $value) {
          $fieldnames = array("qCount", "qRight");
          $condition = "q_id = ".$value['q_id'];
          $question = $this->db->select('questions', $fieldnames, $condition);
          $qRight = $question[0]['qRight'];
          $qCount = $question[0]['qCount'];
          $qCount++;
          if ($value['answer'] == 1) {
            $qRight++;
          }
          $percentage = round(($qRight / $qCount) * 100);
          if ($percentage >= 95 && $percentage <= 100) {
            $qDifficulty = "Easy";
          }elseif ($percentage >= 85 && $percentage <= 94) {
            $qDifficulty = "Average";
          }elseif ($percentage <= 84) {
            $qDifficulty = "Hard";
          }
          //update question
          $data = array(
            'qCount'      => $qCount,
            'qRight'      => $qRight,
            'qDifficulty' => $qDifficulty
          );
          $condition = "q_id = ". $value['q_id'];
          $result = $this->db->update("questions", $data, $condition);
        }
        //insert test result
        $data = array(
          'r_id'          => null,
          'test_id'       => $test_id,
          'u_id'          => $u_id,
          'rTotalItems'   => $totalItems,
          'rScore'        => $score
        );
        $result = $this->db->insert('results', $data);

      }else {
        $testAnswers  = $_POST['testAnswers'];
        $test_id      = $_POST['testId'];
        $totalItems   = count($_POST['testAnswers']);
        $score        = 0;

        //get question details
        foreach ($testAnswers as $value) {
          $fieldnames = array("qCount", "qRight");
          $condition = "q_id = ".$value['q_id'];
          $question = $this->db->select('questions', $fieldnames, $condition);
          $qRight = $question[0]['qRight'];
          $qCount = $question[0]['qCount'];
          $qCount++;
          if ($value['answer'] == 1) {
            $qRight++;
            $score++;
          }
          $percentage = round(($qRight / $qCount) * 100);
          if ($percentage >= 95 && $percentage <= 100) {
            $qDifficulty = "Easy";
          }elseif ($percentage >= 85 && $percentage <= 94) {
            $qDifficulty = "Average";
          }elseif ($percentage <= 84) {
            $qDifficulty = "Hard";
          }
          //update question
          $data = array(
            'qCount'      => $qCount,
            'qRight'      => $qRight,
            'qDifficulty' => $qDifficulty
          );
          $condition = "q_id = ". $value['q_id'];
          $result = $this->db->update("questions", $data, $condition);
        }
        //insert test result
        $data = array(
          'r_id'          => null,
          'test_id'       => $test_id,
          'u_id'          => $u_id,
          'rTotalItems'   => $totalItems,
          'rScore'        => $score
        );
        $result = $this->db->insert('results', $data);
      }


      //get past test results
      // $fieldnames = array("*");
      // $condition  = "u_id = $u_id";
      // $result     = $this->db->select('results', $fieldnames, $condition);
      // $testData   = array();
      // foreach ($result as $value) {
      //   $testData['correct'][] = $value['rScore'];
      //   $testData['wrong'][] = $value['rTotalItems'] - $value['rScore'];
      //   $testData['dates'][] = $value['rDateTaken'];
      // }

      return json_encode(1);
    }


  }
