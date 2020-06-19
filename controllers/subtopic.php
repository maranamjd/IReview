<?php

  /**
   *
   */
  class Subtopic extends Controller
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
    // function index(){
    //   $this->view->page = 'Subtopic';
    //   $this->view->js = array('subtopic/js/default.js');
    //   $this->view->render('subtopic/index');
    // }

    function addQuestion(){
      echo $this->model->addQuestion();
    }

    function view($id){
      $data = $this->model->view($id);
      $this->view->page = $data[0]['stName'];
      $this->view->data = $data;
      $this->view->js = array('subtopic/js/default.js');
      $this->view->render('subtopic/index');
    }
    function getTest($key){
      echo $this->model->getTest($key);
    }
    function addTest(){
      echo $this->model->addTest();
    }
    function deleteTest(){
      echo $this->model->deleteTest();
    }
    function updateTest(){
      echo $this->model->updateTest();
    }

    function deleteQuestion(){
      echo $this->model->deleteQuestion();
    }
    function updateQuestion(){
      echo $this->model->updateQuestion();
    }
  }
