<?php

  /**
   *
   */
  class Statistics_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }

    public function getStats($category){
      $easy = 0; $hard = 0; $ave = 0;
      if ($category != '*') {
        $data = array('test_id');
        $condition = "testCategory = '$category'";
        $testids = $this->db->select('tests', $data, $condition);
        foreach ($testids as $key => $id) {
          $diff = $this->db->select('questions', ['qDifficulty'], 'test_id = '.$id['test_id']);
          if (count($diff) > 0) {
            foreach ($diff as $key => $difficulty) {
              if ($difficulty['qDifficulty'] == 'Easy') {
                $easy++;
              }elseif ($difficulty['qDifficulty'] == 'Average') {
                $ave++;
              }elseif ($difficulty['qDifficulty'] == 'Hard') {
                $hard++;
              }
            }
          }
        }
        $qdata['easy'] = $easy;
        $qdata['average'] = $ave;
        $qdata['hard'] = $hard;
        $qdata['total'] = $easy + $ave + $hard;
        $result['questions'] = $qdata;



        $pass = [0,0,0,0,0,0,0,0,0,0,0,0];
        $fail = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($testids as $key => $res) {
          $fieldnames = array('rTotalItems', 'rScore', 'rDateTaken');
          $results = $this->db->select('results', $fieldnames, "test_id = ".$res['test_id']);
          if (count($results) > 0) {
            foreach ($results as $value) {
              $month      = date_format(date_create(explode(" ", $value['rDateTaken'])[0]), 'n') - 1;
              $percentage = round(($value['rScore'] / $value['rTotalItems']) * 100);
              if ($percentage >= 75) {
                $pass[$month]++;
              }else {
                $fail[$month]++;
              }
            }
          }
        }
        $rdata['pass'] = $pass;
        $rdata['fail'] = $fail;
        $result['results'] = $rdata;

        return json_encode($result);
      }else {
        //questions
        $qdata['easy']     = $this->db->select('questions', array("COUNT(qDifficulty) as 'easy'"), "qDifficulty = 'Easy'")[0]['easy'];
        $qdata['average']  = $this->db->select('questions', array("COUNT(qDifficulty) as 'average'"), "qDifficulty = 'Average'")[0]['average'];
        $qdata['hard']     = $this->db->select('questions', array("COUNT(qDifficulty) as 'hard'"), "qDifficulty = 'Hard'")[0]['hard'];
        $qdata['total']    = $qdata['easy'] + $qdata['average'] + $qdata['hard'];
        $result['questions'] = $qdata;


        $fieldnames = array('rTotalItems', 'rScore', 'rDateTaken');
        $results = $this->db->select('results', $fieldnames, "1");
        $pass = [0,0,0,0,0,0,0,0,0,0,0,0];
        $fail = [0,0,0,0,0,0,0,0,0,0,0,0];

        foreach ($results as $value) {
          $month      = date_format(date_create(explode(" ", $value['rDateTaken'])[0]), 'n') - 1;
          $percentage = round(($value['rScore'] / $value['rTotalItems']) * 100);
          if ($percentage >= 75) {
            $pass[$month]++;
          }else {
            $fail[$month]++;
          }
        }

        $rdata['pass'] = $pass;
        $rdata['fail'] = $fail;
        $result['results'] = $rdata;

        return json_encode($result);
      }
    }


    public function export($category){
      $pdf = new FPDF('L');
      $fn = new Hash();
      switch ($category) {
        case 'questions':

          $pdf->AddPage();
          $pdf->SetLeftMargin(35);
          $pdf->SetTopMargin(35);
          $pdf->SetRightMargin(35);
          $pdf->AddFont('Calibri','','Calibri.php');
          $pdf->AddFont('Calibri Bold','','Calibri Bold.php');
          $pdf->SetY(20);
          $pdf->SetFont('Calibri Bold','',18);
          $pdf->Cell(0, 8, "Questions Summary", 0, 1, 'C', false);
          $pdf->Image(URL.'public/img/ireview4.png', 30, 5, 60);
          $pdf->SetY(40);
          $pdf->Cell(0,8,'',"B",1,'C',false);
          $pdf->SetY(50);
          $pdf->SetFont('Calibri','',12);
          $pdf->Cell(20, 8, "Date:", 0, 0, 'L', false);
          $pdf->Cell(55, 8, date('F d, Y'), 0, 1, 'L', false);
          $pdf->setY(100);
          $pdf->Cell(45, 8, "Category", 1, 0, 'C', false);
          $pdf->Cell(45, 8, "No. of Question", 1, 0, 'C', false);
          $pdf->SetTextColor(255,255,255);
          $pdf->SetFillColor(48,255,64);
          $pdf->Cell(45, 8, "Easy", 1, 0, 'C', true);
          $pdf->SetFillColor(48,64,224);
          $pdf->Cell(45, 8, "Average", 1, 0, 'C', true);
          $pdf->SetFillColor(255,48,64);
          $pdf->Cell(45, 8, "Hard", 1, 1, 'C', true);
          $pdf->SetFont('Calibri','',14);
          $pdf->SetTextColor(0,0,0);
          $mc = $fn->category('Multiple Choice');
          $pdf->Cell(45, 8, "Multiple Choice", 1, 0, 'L', false);
          $pdf->Cell(45, 8, $mc['total'], 1, 0, 'C', false);
          $pdf->Cell(45, 8, $mc['easy'], 1, 0, 'C', false);
          $pdf->Cell(45, 8, $mc['average'], 1, 0, 'C', false);
          $pdf->Cell(45, 8, $mc['hard'], 1, 1, 'C', false);
          $pdf->SetFillColor(238,238,238);
          $tf = $fn->category('True or False');
          $pdf->Cell(45, 8, "True or False", 1, 0, 'L', true);
          $pdf->Cell(45, 8, $tf['total'], 1, 0, 'C', true);
          $pdf->Cell(45, 8, $tf['easy'], 1, 0, 'C', true);
          $pdf->Cell(45, 8, $tf['average'], 1, 0, 'C', true);
          $pdf->Cell(45, 8, $tf['hard'], 1, 1, 'C', true);
          $en = $fn->category('Enumeration');
          $pdf->Cell(45, 8, "Enumeration", 1, 0, 'L', false);
          $pdf->Cell(45, 8, $en['total'], 1, 0, 'C', false);
          $pdf->Cell(45, 8, $en['easy'], 1, 0, 'C', false);
          $pdf->Cell(45, 8, $en['average'], 1, 0, 'C', false);
          $pdf->Cell(45, 8, $en['hard'], 1, 1, 'C', false);

          $pdf->Output('I');
          break;

        case 'results':
          $pdf->AddPage();
          $pdf->SetLeftMargin(35);
          $pdf->SetTopMargin(35);
          $pdf->SetRightMargin(35);
          $pdf->AddFont('Calibri','','Calibri.php');
          $pdf->AddFont('Calibri Bold','','Calibri Bold.php');
          $pdf->SetY(20);
          $pdf->SetFont('Calibri Bold','',18);
          $pdf->Cell(0, 8, "Test Result Summary", 0, 1, 'C', false);
          $pdf->Image(URL.'public/img/ireview4.png', 30, 5, 60);
          $pdf->SetY(40);
          $pdf->Cell(0,8,'',"B",1,'C',false);
          $pdf->SetY(50);
          $pdf->SetFont('Calibri','',12);
          $pdf->Cell(20, 8, "Date:", 0, 0, 'L', false);
          $pdf->Cell(55, 8, date('F d, Y'), 0, 1, 'L', false);
          $pdf->setY(70);
          $pdf->Cell(55, 8, "Month", 1, 0, 'C', false);
          $pdf->Cell(55, 8, "No. of Test", 1, 0, 'C', false);
          $pdf->SetTextColor(255,255,255);
          $pdf->SetFillColor(48,255,64);
          $pdf->Cell(55, 8, "Pass", 1, 0, 'C', true);
          $pdf->SetFillColor(255,48,64);
          $pdf->Cell(55, 8, "Fail", 1, 1, 'C', true);
          $pdf->SetFont('Calibri','',14);
          $pdf->SetTextColor(0,0,0);
          $res = $fn->result();
          $i = 0;
          $pdf->SetFillColor(238,238,238);
          foreach ($res['months'] as $value) {
            if($i%2 == 1){
              $fill = true;
            }else {
              $fill = false;
            }
            $pdf->Cell(55, 8, $value, 1, 0, 'L', $fill);
            $pdf->Cell(55, 8, $res['pass'][$i] + $res['fail'][$i], 1, 0, 'C', $fill);
            $pdf->Cell(55, 8, $res['pass'][$i], 1, 0, 'C', $fill);
            $pdf->Cell(55, 8, $res['fail'][$i], 1, 1, 'C', $fill);
            $i++;
          }


          $pdf->Output('I');
          break;
      }
    }

  }
