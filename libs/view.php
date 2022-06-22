<?php

  class View{

    function __construct(){
      error_log('VIEW::CONSTRUCT-> inicio de view(libs)');
    }


    function render($nombre, $data = []){
      $this->d = $data;          
      error_log('VIEW::RENDER-> '. $nombre);

      $this->handleMessages();

      require 'views/' . $nombre . '.php';
    }


    private function handleMessages(){
      error_log('VIEW::handleMessages');
      if(isset($_GET['success']) && isset($_GET['error'])){
          // no se muestra nada porque no puede haber un error y success al mismo tiempo
      }else if(isset($_GET['success'])){
          
          $this->handleSuccess();
      }else if(isset($_GET['error'])){
          $this->handleError();
      }
    }

    private function handleError(){
      error_log('VIEW::handleError');
      if(isset($_GET['error'])){
          $hash = $_GET['error'];
          $errors = new ErrorMessages();

          if($errors->existsKey($hash)){
              error_log('View::handleError() existsKey =>' . $errors->get($hash));
              $this->d['error'] = $errors->get($hash);
          }else{
              $this->d['error'] = NULL;
          }
      }
    }

    private function handleSuccess(){
      error_log('VIEW::handleSuccess');
      if(isset($_GET['success'])){
          $hash = $_GET['success'];
          $success = new SuccessMessages();

          if($success->existsKey($hash)){
              error_log('View::handleError() existsKey =>' . $success->existsKey($hash));
              $this->d['success'] = $success->get($hash);
          }else{
              $this->d['success'] = NULL;
          }
      }
    }

    public function showMessages(){
      error_log('VIEW::showMessages');
      $this->showError();
      $this->showSuccess();
    }

    public function showError(){
      error_log('VIEW::showError');
      if(array_key_exists('error', $this->d)){
          echo '<div class="error">'.$this->d['error'].'</div>';
      }
    }

    public function showSuccess(){
      error_log('VIEW::showSuccess');
      if(array_key_exists('success', $this->d)){
          echo '<div class="success">'.$this->d['success'].'</div>';
      }
    }

  }

?>