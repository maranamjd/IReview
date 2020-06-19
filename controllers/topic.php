<?php

  /**
   *
   */
  class Topic extends Controller
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
      $this->view->page = 'topic';
      $this->view->js = array('topic/js/default.js');
      $this->view->render('topic/index');
    }
    function view($key){
      $this->model->view($key);
    }
    function updateTopic(){
      $this->model->updateTopic();
    }
    function deleteTopic(){
      $this->model->deleteTopic();
    }
    function addTopic(){
      $this->model->addTopic();
    }
    function addSubtopic(){
      $this->model->addSubtopic();
    }
    function updateSubtopic(){
      $this->model->updateSubtopic();
    }
    function deleteSubtopic(){
      $this->model->deleteSubtopic();
    }
    function addSubtopicToFav(){
      $this->model->addSubtopicToFav();
    }
    function removeSubtopicFromFav(){
      $this->model->removeSubtopicFromFav();
    }

  }
