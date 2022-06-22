<?php

  class Controller{

      function __construct(){
          error_log('CONTROLLER::CONSTRUCT-> inicio de controller(libs)');
          $this->view = new View();
      }


    function loadModel($model){
      error_log('CONTROLLER::loadModel-> '. $model);
      $url = 'models/'.$model.'model.php';

      if(file_exists($url)){
          require_once $url;

          $modelName = $model.'Model';
          $this->model = new $modelName();
      }
    }

    function existPOST($params){
      foreach ($params as $param) {
          if(!isset($_POST[$param])){
              error_log("ExistPOST: No existe el parametro $param" );
              return false;
          }
      }
      error_log( "ExistPOST: Existen parámetros" );
      return true;
    }

    function existGET($params){
      foreach ($params as $param) {
          if(!isset($_GET[$param])){
              error_log("ExistGET: No existe el parametro $param" );
              return false;
          }
      }
      error_log( "ExistGET: Existen parámetros" );
      return true;
    }

    function getGet($name){
      error_log("getGet(".$name.")" );
      return $_GET[$name];
    }

    function getPost($name){
      error_log("getPost(".$name.")" );
      return $_POST[$name];
    }

    function redirect($url, $mensajes = []){
      $data = [];
      $params = '';
      
      foreach ($mensajes as $key => $value) {
          array_push($data, $key . '=' . $value);
      }
      $params = join('&', $data);
      
      if($params != ''){
          $params = '?' . $params;
      }
      error_log("redirect: " . $url .'/'. $params);
      header('location: ' . constant('URL') .'/'. $url . $params);
    }
  }

?>