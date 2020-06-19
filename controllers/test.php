<?php

  /**
   *
   */
  class Test extends Controller
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
      $this->view->page = 'Test';
      $this->view->css = array('test/css/default.css');
      $this->view->js = array('test/js/default.js');
      $this->view->render('test/index');
    }

    function export($id){
      $this->model->export($id);
    }

    function view($key){
      $data = $this->model->view($key);
      if (isset($data[0]['testName'])) {
        $this->view->page = $data[0]['testName'];
      }else {
        header('Location: '. URL . 'subtopic/view/'. $key);
      }
      $this->view->data = $data;
      $this->view->js = array('test/js/default.js');
      $this->view->css = array('test/css/default.css');
      $this->view->render('test/index');
    }


    function take($id){
      if (Session::get('allowed') == true) {
        Session::set(array('allowed' => false));
        $data = $this->model->take($id);
        $this->view->data = $data;
        $this->view->page = $data['testName'];
        $this->view->js = array('test/js/questions.js');
        $this->view->css = array('test/css/default.css');
        $this->view->render('test/questions', 1, 0);
      }else {
        header('Location: '. URL . 'test/view/'. $id);
      }
      if (isset($_POST['isClick'])) {
        Session::set(array('allowed' => true));
      }
    }

    function get(){
      echo $this->model->get();
    }

    function prepare(){
      echo $this->model->prepare();
    }
    function has(){
      echo $this->model->has();
    }

    function testProgress(){
      echo $this->model->testProgress();
    }

    function progress($id){
      $data = $this->model->progress($id);
      if (isset($data[0]['testName'])) {
        $this->view->page = $data[0]['testName'];
      }else {
        header('Location: '. URL . 'test/view/'. $id);
      }
      $this->view->data = $data;
      $this->view->js = array('test/js/progress.js');
      $this->view->css = array('test/css/default.css');
      $this->view->render('test/progress');
    }

    function data($id){
      $data = $this->model->data($id);
      if (isset($data['test']['testName'])) {
        $this->view->page = $data['test']['testName'];
      }else {
        header('Location: '. URL . 'test/view/'. $id);
      }
      $this->view->data = $data;
      $this->view->js = array('test/js/data.js');
      $this->view->css = array('test/css/default.css', 'test/css/data.css');
      $this->view->render('test/data');
    }

  }
