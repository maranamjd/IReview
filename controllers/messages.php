<?php

  /**
   *
   */
  class Messages extends Controller
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
      $this->view->data = $this->model->getMessages();
      $this->view->page = 'messages';
      $this->view->js   = array('messages/js/default.js');
      $this->view->css   = array('messages/css/default.css');
      $this->view->render('messages/index');
    }
  }
