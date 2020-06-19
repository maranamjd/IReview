<?php
  /**
   *
   */
  class User extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $logged = Session::get('loggedin');
      $utype  = Session::get('utype');
      if ($logged == true) {
        switch ($utype) {
          case 'Encoder':
          header('Location: '.URL.'topic');
            break;
          case 'Visitor':
          header('Location: '.URL.'topics');
            break;
        }
      }else {
        Session::destroy();
        header('Location: '.URL);
        exit;
      }
    }

    function index(){
      $data = $this->model->data();
      $this->view->page = "users";
      $this->view->data = $data;
      $this->view->js = array('user/js/default.js');
      $this->view->css = array('user/css/default.css');
      $this->view->render('user/index');
    }

    function deactivate(){
      echo $this->model->deactivate();
    }
    function activate(){
      echo $this->model->activate();
    }
    function update(){
      echo $this->model->update();
    }
  }
