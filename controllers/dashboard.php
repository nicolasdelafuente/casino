<?php

  class Dashboard extends SessionController {
    
    private $user;

    function __construct() {
      parent::__construct();

      $this->user = $this->getUserSessionData();
      error_log("Dashboard::constructor() ");
    }

    function render()
    {
      error_log('DASHBOARD::RENDER-> Carga el index de Dashboard');
      
      $expenses         = $this->getExpenses();
      $amount           = $this->getTotalAmoun();
      $dineroApostado    = $this->getDineroApostado();

      $this->view->render('dashboard/index', [
        'user'                 => $this->user,
        'expenses'             => $expenses,
        'amount'               => $amount,
        'dineroApostado '      => $dineroApostado
      ]);
    }

    public function getExpenses() {     
      $expenses = new ExpensesModel();
      return $expenses->getAllByUserId($this->user->getId());  
    }

    public function getTotalAmoun() {
      $expenses = new ExpensesModel();
      return $expenses->getTotalAmount($this->user->getId());
    }

    public function getDineroApostado() {
      $expenses = new ExpensesModel();
      return $expenses->getTotalApostado($this->user->getId());
    }

    
  }

?>