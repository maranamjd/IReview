<?php

  /**
   *
   */
  class Hash
  {

    function __construct()
    {
      // echo 'this is the view<br>';
      $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }

    public function encrypt($txt){
      $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
      $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $txt, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
      return( $qEncoded );
    }
    public function decrypt($hash){
      $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
      $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $hash ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
      return( $qDecoded );
    }
    public function category($category){

      $easy = 0; $hard = 0; $ave = 0;
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
      return $qdata;
    }

    public function result(){
      $fieldnames = array('rTotalItems', 'rScore', 'rDateTaken');
      $results = $this->db->select('results', $fieldnames, "1");
      $pass = [0,0,0,0,0,0,0,0,0,0,0,0];
      $fail = [0,0,0,0,0,0,0,0,0,0,0,0];
      $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

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
      $rdata['months'] = $months;
      return $rdata;
    }
  }
