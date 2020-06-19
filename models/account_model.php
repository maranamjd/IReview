<?php

  /**
   *
   */
  class Account_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }
    
    public function changeProfile(){
      $u_id = Session::get('uid');
      $currentimage = 'public/img/'.Session::get('uimage');
      $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
      $extArr = ['png','jpg','jpeg', 'gif'];

      if($ext != 'png' && $ext != 'jpg' && $ext != 'jpeg'&& $ext != 'gif'){
        return 1;
      }
      else {
        $new_name = rand() . '.' . $ext;
        $destination = 'public/img/' . $new_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
        $data = array(
          'uImage' => $new_name
        );
        $condition = "u_id = $u_id";
        $result = $this->db->update('users', $data, $condition);

        if(!empty($result)){
          if(Session::get('uimage') != 'unknown.png')
            unlink($currentimage);

          return $new_name;
        }
      }
    }
    public function updateInfo(){
      $u_id = Session::get('uid');
      $fname = $_POST['fname'];
      $mname = $_POST['mname'];
      $lname = $_POST['lname'];
      $data = array(
        'uFirstName'  => $fname,
        'uMiddleName' => $mname,
        'uLastName'   => $lname
      );

      $condition = "u_id = $u_id";
      $result = $this->db->update("users", $data, $condition);

      if ($result == 1) {
        return array('result' => 1, 'fname' => $fname, 'mname' => $mname, 'lname' => $lname);
      }else {
        return array('result' => 0);
      }
    }

    public function updatePassword(){
      $u_id = Session::get('uid');
      $pass = $this->hash->encrypt($_POST['pass']);

      $data = array(
        'uPassword'  => $pass
      );

      $condition = "u_id = $u_id";
      $result = $this->db->update("users", $data, $condition);

      if ($result) {
        return "Password Updated.";
      }else {
        return "Password update failed!";
      }

    }

  }
