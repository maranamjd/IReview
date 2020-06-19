<?php

  /**
   *
   */
  class Topics extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $logged = Session::get('loggedin');
      $utype  = Session::get('utype');
      if ($logged == true) {
        switch ($utype) {
          case 'Administrator':
          header('Location: '.URL.'dashboard');
            break;
          case 'Encoder':
          header('Location: '.URL.'topic');
            break;
        }
      }else {
        Session::destroy();
        header('Location: '.URL);
        exit;
      }
    }
    function index(){
      $this->view->page = 'topics';
      $this->view->js = array('topics/js/default.js');
      $this->view->render('topics/index');
    }
    function view($key){
      echo $this->model->view($key);
    }
    function addSubtopicToFav(){
      echo $this->model->addSubtopicToFav();
    }
    function removeSubtopicFromFav(){
      echo $this->model->removeSubtopicFromFav();
    }

  }
