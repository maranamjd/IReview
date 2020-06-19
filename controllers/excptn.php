<?php

  /**
   *
   */
  class Excptn extends Controller
  {

    function __construct()
    {
      parent::__construct();
    }

    function index(){
      $this->view->page = 'Page not found!';
      $this->view->css = array('excptn/css/default.css');
      $this->view->render('excptn/index', 1, 0);
    }
  }
