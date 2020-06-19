<?php
  /**
   *
   */
  class Dashboard extends Controller
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
      $this->view->page = 'dashboard';
      $this->view->js = array('dashboard/js/default.js');
      $this->view->css = array('dashboard/css/default.css');
      $this->view->render('dashboard/index');
    }

    function getData(){
      echo $this->model->getData();
    }
  }
