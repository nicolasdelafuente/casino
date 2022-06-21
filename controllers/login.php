<?php

  class Login extends Controller {

    function __construct() {
      error_log('LOGIN::CONSTRUCT-> Inicio de Login');
      parent::__construct();
    }

    function render()
    {
      error_log('LOGIN::RENDER-> Carga el index de Login');
      $this->view->render('login/index');
    }
  }

?>