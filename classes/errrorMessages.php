<?php

  class ErrorMessages{
    //ERROR|SUCCESS
    //Controller
    //method
    //operation

    const PRUEBA = "1234";

    private $errorsList = [];

    public function __construct(){
      error_log('ErrorMessages::CONSTRUCT-> inicio de ErrorMessages');

      $this->errorsList = [
        ErrorMessages::PRUEBA=> 'Este es un ejemplo de error',
      ];
    }


    function get($hash){
      return $this->errorsList[$hash];
    }

    function existsKey($key){
      if(array_key_exists($key, $this->errorsList)){
          return true;
      }else{
          return false;
      }
    }

  }
?>