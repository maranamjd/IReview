<?php

  /**
   *
   */
  class View
  {

    function __construct()
    {
      // echo 'this is the view<br>';
      $this->sessionData = Session::get(array(
        'uid',
        'uimage',
        'firstname',
        'middlename',
        'utype',
        'ubackground',
        'lastname'
      ));
    }

    public function render($name, $include = false, $nav = false){
      if ($include == true && $nav == true) {
        require 'views/'. $name .'.php';
      }elseif ($include == true && $nav == false) {
        require 'views/inc/header.php';
        require 'views/'. $name .'.php';
        require 'views/inc/footer.php';
        require 'views/inc/msgModal.php';
        require 'views/inc/alertModal.php';
      }elseif ($include == false && $nav == true) {
        require 'views/inc/top-nav.php';
        require 'views/'. $name .'.php';
        require 'views/inc/alertModal.php';
        require 'views/inc/msgModal.php';
      }else {
        require 'views/inc/header.php';
        require 'views/inc/top-nav.php';
        require 'views/'. $name .'.php';
        require 'views/inc/msgModal.php';
        require 'views/inc/alertModal.php';
        require 'views/inc/footer.php';
      }
    }
  }
