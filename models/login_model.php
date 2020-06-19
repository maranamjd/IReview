<?php

  /**
   *
   */
  class Login_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }
    public function run(){
      $fields = array('u_id', 'uImage', 'uBackground', 'uFirstName', 'uMiddleName', 'uLastName', 'uType', 'uActive');
      $username = $_POST['username'];
      $password = $this->hash->encrypt($_POST['password']);
      $condition = "uName = '$username' AND uPassword = '$password'";
      $result = $this->db->select('users', $fields, $condition);
      $count = sizeof($result);

      if ($count == 1) {
        if ($result[0]['uActive'] == 1) {
          if ($password == $this->hash->encrypt($result[0]['uLastName'])) {
            $default = true;
          }else {
            $default = false;
          }
          Session::set(array(
            'loggedin'    => true,
            'firstname'   => $result[0]['uFirstName'],
            'middlename'  => $result[0]['uMiddleName'],
            'lastname'    => $result[0]['uLastName'],
            'uid'         => $result[0]['u_id'],
            'uimage'      => $result[0]['uImage'],
            'utype'       => $result[0]['uType'],
            'ubackground' => $result[0]['uBackground'],
            'default'     => $default
          ));
          if ($default) {
            return '3';
          }else {
            return $count;
          }
        }else {
          return '2';
        }
      }else {
        return $count;
      }

    }

    public function register(){
      $fields = array('u_id');
      $username = $_POST['uname'];
      $condition = "uName = '$username'";
      $result = $this->db->select('users', $fields, $condition);
      $count = sizeof($result);

      if ($count == 1) {
        return '3';
      }else {
        $data = array(
          'u_id'        => null,
          'uFirstName'  => $_POST['firstname'],
          'uMiddleName' => $_POST['middlename'],
          'uLastName'   => $_POST['lastname'],
          'uName'       => $_POST['uname'],
          'uPassword'   => $this->hash->encrypt($_POST['lastname'])
        );
        $result = $this->db->insert('users', $data);

        if ($result == 1) {
          return '1';
        }else {
          return '2';
        }
      }
    }
  }
