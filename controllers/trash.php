<?php

  /**
   *
   */
  class Trash extends Controller
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
    function index(){
      $this->view->page = 'trash';
      $this->view->js = array('trash/js/default.js');
      $this->view->render('trash/index');
    }
    function subtopic($key){
      echo $this->model->subtopic($key);
    }
    function restoreSubTopic(){
      echo $this->model->restoreSubTopic();
    }
    function deleteSubTopic(){
      echo $this->model->deleteSubTopic();
    }
    function topic($key){
      echo $this->model->topic($key);
    }
    function restoreTopic(){
      echo $this->model->restoreTopic();
    }
    function deleteTopic(){
      echo $this->model->deleteTopic();
    }
    function test($key){
      echo $this->model->test($key);
    }
    function restoreTest(){
      echo $this->model->restoreTest();
    }
    function deleteTest(){
      echo $this->model->deleteTest();
    }
  }
