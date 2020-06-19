<?php

  /**
   *
   */
  class Database extends PDO
  {

    function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
    {
      parent::__construct($DB_TYPE.':host='.$DB_HOST.';dbname='.$DB_NAME, $DB_USER, $DB_PASS);
      parent::setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function select($table, $data, $condition){
      ksort($data);

      $fieldnames = null;
      foreach ($data as $key => $value) {
        $fieldnames .= $value.", ";
      }
      $fieldnames = rtrim($fieldnames, ', ');
      $sth = $this->prepare("SELECT $fieldnames FROM $table WHERE $condition");
      $sth->execute();
      return $sth->fetchAll();
      // return "SELECT $fieldnames FROM $table WHERE $condition";
    }

    public function insert($table, $data){
      ksort($data);

      $fieldnames   = implode(', ', array_keys($data));
      $fieldvalues  = ":" . implode(', :', array_keys($data));

      $sth = $this->prepare("INSERT INTO $table ($fieldnames) VALUES ($fieldvalues)");
      foreach ($data as $key => $value) {
        $sth->bindValue(":$key", $value);
      }
      $result = $sth->execute();
      return $result;
    }

    public function update($table, $data, $condition){
      ksort($data);

      $fieldetails = null;
      foreach ($data as $key => $value) {
        $fieldetails .= "$key" . " = :$key, ";
      }

      $fieldetails = rtrim($fieldetails, ', ');

      $sth = $this->prepare("UPDATE $table SET $fieldetails WHERE $condition");
      foreach ($data as $key => $value) {
        $sth->bindValue(":$key", $value);
      }
      $result = $sth->execute();
      return $result;
    }

    public function delete($table, $condition){

      $sth = $this->prepare("DELETE FROM $table WHERE $condition");
      $result = $sth->execute();
      return $result;
    }

  }
