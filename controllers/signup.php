<?php

  class Signup extends SessionController{
    
    function __construct(){
      error_log('SIGNUP::CONSTRUCT-> Inicio de Signup');
      parent::__construct();
    }


    function render(){
      $this->view->errorMessage = '';
      error_log('SIGNUP::RENDER-> Carga el Signup de login');
      $this->view->render('login/signup');
    }
  }

?>