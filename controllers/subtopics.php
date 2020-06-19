<?php

  /**
   *
   */
  class Subtopics extends Controller
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
    // function index(){
    //   $this->view->page = 'Subtopic';
    //   $this->view->js = array('subtopic/js/default.js');
    //   $this->view->render('subtopic/index');
    // }

    function view($id){
      $data = $this->model->view($id);
      $this->view->page = $data[0]['stName'];
      $this->view->data = $data;
      $this->view->js = array('subtopics/js/default.js');
      $this->view->render('subtopics/index');
    }
    function getTest($key){
      echo $this->model->getTest($key);
    }
  }
