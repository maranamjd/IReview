<?php

  /**
   *
   */
  class Statistics extends Controller
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
      $this->view->page = 'statistics';
      $this->view->js   = array('statistics/js/default.js');
      $this->view->css   = array('statistics/css/default.css');
      $this->view->render('statistics/index');
    }
    function getStats($category){
      echo $this->model->getStats($category);
    }
    function export($category){
      $this->model->export($category);
    }
  }
