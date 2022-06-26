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
      
      $transactions         = $this->getExpenses();
      $amount           = $this->getTotalAmount();

      $this->view->render('dashboard/index', [
        'title'                 => 'Dasboard',
        'user'                  => $this->user,
        'amount'                => $amount,
        'transactions'              => $transactions,
      ]);
    }   

    public function getExpenses() {     
      $transactions = new JoinExpensesCategoriesModel();
      return $transactions->getAll($this->user->getId());  
    }

    public function getTotalAmount() {
      $transactions = new TransactionsModel();
      return $transactions->getTotalAmount($this->user->getId());
    }

    
  }

?>