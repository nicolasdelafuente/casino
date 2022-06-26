<?php

  class Jugar extends SessionController {
    
    private $user;

    function __construct() {
      parent::__construct();

      $this->user = $this->getUserSessionData();
      error_log("JUGAR::constructor() ");
    }

    function render()
    {
      error_log('JUGAR::RENDER-> Carga el index de Jugar');
      $this->view->render('jugar/index', [
        'title'                 => 'Jugar',
      ]);
    }   

    
  }

?>