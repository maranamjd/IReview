<?php

  /**
   *
   */
  class Favorites extends Controller
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
        $this->view->page = 'favorites';
        $this->view->js = array('favorites/js/default.js');
        $this->view->render('favorites/index');
    }
    function view($key){
      echo $this->model->view($key);
    }
    function updateSubtopic(){
      echo $this->model->updateSubtopic();
    }
    function deleteSubtopic(){
      echo $this->model->deleteSubtopic();
    }
    function removeSubtopicFromFav(){
      echo $this->model->removeSubtopicFromFav();
    }
  }
