<?php

  /**
   *
   */
  class User_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }

    public function data(){
      $fieldnames = array('u_id', 'uImage', 'uFirstName', 'uMiddleName', 'uLastName', 'uType', 'uActive');
      $condition  = "uType != 'Administrator'";
      $result     = $this->db->select('users', $fieldnames, $condition);
      $data = array();
      $users = array();
      foreach ($result as $value) {
        if ($value['uType'] == 'Encoder') {
          $type = "E";
        }elseif ($value['uType'] == 'Visitor') {
          $type = "V";
        }
        if ($value['u_id'] < 10 && $value['u_id'] > 0) {
          $rCode = "-00";
        }elseif ($value['u_id'] < 100 && $value['u_id'] > 9) {
          $rCode = "-0";
        }else {
          $rCode = "-";
        }

        $data['u_id']     = $type.$rCode.$value['u_id'];
        $data['uImage']   = $value['uImage'];
        $data['uName']    = $value['uFirstName']." ".ucfirst($value['uMiddleName'][0]).". ".$value['uLastName'];
        $data['uActive']  = ($value['uActive'] == 1) ? "<span class='btn-small green uActive'>Active<input type='hidden' id='u_id' value='".$value['u_id']."'></span>" : "<span class='btn-small red uInActive'>Inactive<input type='hidden' id='u_id' value='".$value['u_id']."'></span>";
        $data['aLevel']   = $value['uType'];
        $data['action']   = "<span class='btn-small blue uDetails'><i class='material-icons'>list</i><input type='hidden' id='img' value='".$value['uImage']."'><input type='hidden' id='uid' value='".$type.$rCode.$value['u_id']."'><input type='hidden' id='userid' value='".$value['u_id']."'><input type='hidden' id='name' value='".$value['uFirstName']." ".ucfirst($value['uMiddleName'][0]).". ".$value['uLastName']."'><input type='hidden' id='type' value='".$value['uType']."'></span>";
        $users[]          = $data;
      }

      return $users;
    }

    public function deactivate(){
      $u_id = $_POST['u_id'];
      $data = array(
        'uActive' => 0
      );
      $condition = "u_id = $u_id";
      $result = $this->db->update('users', $data, $condition);

      return $result;
    }
    public function activate(){
      $u_id = $_POST['u_id'];
      $data = array(
        'uActive' => 1
      );
      $condition = "u_id = $u_id";
      $result = $this->db->update('users', $data, $condition);

      return $result;
    }

    public function update(){
      $u_id = $_POST['u_id'];
      $u_type = $_POST['u_type'];
      $data = array(
        'uType' => $u_type
      );
      $condition = "u_id = $u_id";
      $result = $this->db->update('users', $data, $condition);

      if ($result) {
        return "Update Successful.";
      }else {
        return "Update failed!";
      }
    }

  }
