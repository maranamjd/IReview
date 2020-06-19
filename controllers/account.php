<?php

  /**
   *
   */
  class Account extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $logged = Session::get('loggedin');
      if ($logged == false) {
        Session::destroy();
        header('Location: '.URL);
        exit;
      }
    }
    function index(){
      $this->view->page = 'account';
      $this->view->js   = array('account/js/default.js');
      $this->view->css   = array('account/css/default.css');
      $this->view->render('account/index');
    }
    function changeProfile(){
      $data =  $this->model->changeProfile();
      if($data != 1){
        Session::set(array(
          'uimage'  => $data
        ));
        $this->sessionData = Session::get(array(
          'uid',
          'uimage',
          'firstname',
          'middlename',
          'lastname',
          'ubackground'
        ));
        echo 'Profile changed.';
      }else {
        echo 1;
      }
    }
    function updateInfo(){
      $result =  $this->model->updateInfo();
      if ($result['result'] == 1) {
        echo "Account info updated.";
        Session::set(array(
          'firstname'  => $result['fname'],
          'middlename' => $result['mname'],
          'lastname'   => $result['lname']
        ));
        $this->sessionData = Session::get(array(
          'uid',
          'uimage',
          'firstname',
          'middlename',
          'lastname',
          'ubackground'
        ));
      }else {
        echo "Account info update failed!";
      }
    }

    function updatePassword(){
      echo $this->model->updatePassword();
    }
  }
