<?php

  /**
   *
   */
  class Login extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $logged = Session::get('loggedin');
      $utype  = Session::get('utype');
      $default = Session::get('default');
      if ($logged) {
        if ($default) {
          header('Location: '.URL.'account#password');
        }else {
          switch ($utype) {
            case 'Administrator':
              header('Location: '.URL.'dashboard');
              break;
            case 'Encoder':
              header('Location: '.URL.'topic');
              break;
            case 'Visitor':
              header('Location: '.URL.'topics');
              break;
          }
        }
      }
    }
    function index(){
      $this->view->page = 'Login';
      $this->view->css = array('login/css/default.css');
      $this->view->js = array('login/js/default.js');
      $this->view->render('login/index', 1, 0);
    }
    function run(){
      echo $this->model->run();
    }
    function register(){
      echo $this->model->register();
    }
  }
