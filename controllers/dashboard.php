<?php

  class Dashboard extends SessionController {

    function __construct() {
      error_log('DASHBOARD::CONSTRUCT-> Inicio de Dashboard');
      parent::__construct();
    }

    function render()
    {
      error_log('DASHBOARD::RENDER-> Carga el index de Dashboard');
      $this->view->render('dashboard/index');
    }
  }

?>