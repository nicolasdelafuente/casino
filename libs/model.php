<?php

  class Model {

    function __construct(){
      error_log('MODEL::CONSTRUCT-> inicio de controller(libs)');
      $this->db = new Database();
    }

    function query($query){
      return $this->db->connect()->query($query);
    }

    function prepare($query){
      return $this->db->connect()->prepare($query);
    }
  }
  
?>

