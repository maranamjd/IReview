<?php
  /**
   *
   */
  class Home_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }

    public function sendMessage(){
      $data = array(
        'id' => null,
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'message' => $_POST['message']
      );
      try {
        $this->db->insert('messages', $data);
        return json_encode(['res' => 1, 'message' => 'Message Sent!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

  }
