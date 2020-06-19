<?php
  /**
   *
   */
  class Home extends Controller
  {

    function __construct()
    {
      parent::__construct();
    }

    function index(){
      $this->view->page = 'Home';
      $this->view->css = array('home/css/default.css');
      $this->view->js = array('home/js/default.js');
      $this->view->render('home/index', 1, 0);
    }

    function sendMessage(){
      echo $this->model->sendMessage();
    }

  }
