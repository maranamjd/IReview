<?php

  /**
   *
   */
  class Messages_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }

    public function getMessages(){
      return $this->db->select('messages', ['*'], '1');
    }

  }
