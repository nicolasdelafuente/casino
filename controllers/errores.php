<?php
require_once 'models/expensesModel.php';
  class Errores extends Controller{

    function __construct(){
        parent::__construct();
        error_log('ERRORES::CONSTRUCT-> Inicio de errores');
    }

    
    function render() {
      error_log('ERRORES::RENDER-> Carga el index de errores');
      $this->view->render('errores/index');
    }
  }

?>