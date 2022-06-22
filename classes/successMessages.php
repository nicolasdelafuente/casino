<?php

  class SuccessMessages{
    //Success|SUCCESS
    //Controller
    //method
    //operation

    const PRUEBA  = "1234";

    private $SuccesssList = [];

    public function __construct(){
      error_log('SuccessMessages::CONSTRUCT-> inicio de SuccessMessages');

      $this->SuccesssList = [
        SuccessMessages::PRUEBA => 'Este es un mensaje de éxito',
      ];
    }


    function get($hash){
      return $this->SuccesssList[$hash];
    }

    function existsKey($key){
      if(array_key_exists($key, $this->SuccesssList)){
          return true;
      }else{
          return false;
      }
    }

  }
?>