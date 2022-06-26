<?php
  require_once 'models/joinExpensesCategoriesModel.php';

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
      $amount           = $this->getTotalAmount();

      $this->view->render('dashboard/index', [
        'title'                 => 'Dasboard',
        'user'                  => $this->user,
        'amount'                => $amount,
        'expenses'              => $expenses,
      ]);
    }   

    public function getExpenses() {     
      $expenses = new JoinExpensesCategoriesModel();
      return $expenses->getAll($this->user->getId());  
    }

    public function getTotalAmount() {
      $expenses = new ExpensesModel();
      return $expenses->getTotalAmount($this->user->getId());
    }

    
  }

?>