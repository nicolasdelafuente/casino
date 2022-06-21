<?php

  class Controller{

      function __construct(){
          error_log('CONTROLLER::CONSTRUCT');
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
  }

?>