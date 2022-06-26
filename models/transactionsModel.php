<?php

class TransactionsModel extends Model implements IModel{

    private $id;
    private $amount;
    private $categoryid;
    private $date;
    private $userid;

    public function setId($id){ $this->id = $id; }
    public function setAmount($amount){ $this->amount = $amount; }
    public function setCategoryId($categoryid){ $this->categoryid = $categoryid; }
    public function setDate($date){ $this->date = $date; }
    public function setUserId($userid){ $this->userid = $userid; }

    public function getId(){ return $this->id;}
    public function getAmount(){ return $this->amount; }
    public function getCategoryId(){ return $this->categoryid; }
    public function getDate(){ return $this->date; }
    public function getUserId(){ return $this->userid; }


    public function __construct(){
        parent::__construct();
    }

    public function save(){
        try{
            $query = $this->prepare('INSERT INTO transactions (, amount, category_id, date, id_user) VALUES( :amount, :category, :d, :user)');
            $query->execute([
                'amount' => $this->amount, 
                'category' => $this->categoryid, 
                'user' => $this->userid, 
                'd' => $this->date
            ]);
            if($query->rowCount()) return true;

            return false;
        }catch(PDOException $e){
            return false;
        }
    }

    public function getAll(){
        $items = [];

        try{
            $query = $this->query('SELECT * FROM transactions ORDER BY expeneses.date DES');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new TransactionsModel();
                $item->from($p); 
                
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            echo $e;
        }
    }
    
    public function getItem($id){
        try{
            $query = $this->prepare('SELECT * FROM transactions WHERE id = :id');
            $query->execute([ 'id' => $id]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            $this->from($user);

            return $this;
        }catch(PDOException $e){
            return false;
        }
    }

    public function getAllByUserId($userid){
        $items = [];

        try{
            $query = $this->prepare("SELECT * FROM transactions INNER JOIN categories ON category_id = categories.id WHERE id_user = :userid");
            $query->execute([ "userid" => $userid]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new TransactionsModel();
                $item->from($p); 
                
                array_push($items, $item);
            }
            return $items;
            

        }catch(PDOException $e){
            echo $e;
        }
    }

    /**
     * Regresa el monto total de transactions en este mes
     */
    function getTotalAmount($iduser){
        try{
            $query = $this->db->connect()->prepare('SELECT SUM(amount) AS total FROM transactions WHERE id_user = :iduser');
            $query->execute(['iduser' => $iduser]);

            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total == NULL) $total = 0;
            
            return $total;

        }catch(PDOException $e){
            return NULL;
        }
    }


    function getTotalApostado($iduser){
        try{
            $query = $this->db->connect()->prepare('SELECT SUM(amount) AS total FROM transactions WHERE id_user = :iduser and category_id = "3"');
            $query->execute(['iduser' => $iduser]);

            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total == NULL) $total = 0;
            
            var_dump($total);
            return $total;

        }catch(PDOException $e){
            return NULL;
        }
    }
    /**
     * Obtiene el número de transacciones por mes
     */
    function getMaxExpensesThisMonth($iduser){
        try{
            $year = date('Y');
            $month = date('m');
            $query = $this->db->connect()->prepare('SELECT MAX(amount) AS total FROM transactions WHERE YEAR(date) = :year AND MONTH(date) = :month AND id_user = :iduser');
            $query->execute(['year' => $year, 'month' => $month, 'iduser' => $iduser]);

            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total == NULL) $total = 0;
            
            return $total;

        }catch(PDOException $e){
            return NULL;
        }
    }

    public function delete($id){
        try{
            $query = $this->prepare('DELETE FROM transactions WHERE id = :id');
            $query->execute([ 'id' => $id]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public function update(){
        try{
            $query = $this->prepare('UPDATE transactions SET amount = :amount, category_id = :category, date = :d, id_user = :user WHERE id = :id');
            $query->execute([
                'amount' => $this->amount, 
                'category' => $this->categoryid, 
                'user' => $this->userid, 
                'd' => $this->date
            ]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public function from($array){
        $this->id = $array['id'];
        $this->amount = $array['amount'];
        $this->categoryid = $array['category_id'];
        $this->date = $array['date'];
        $this->userid = $array['id_user'];
    }

    /**
     * Obtiene el total de amount de transactions basado en id de categoria
     */
    function getTotalByCategoryThisMonth($categoryid, $userid){
        error_log("TransactionsModel::getTotalByCategoryThisMonth");
        try{
            $total = 0;
            $year = date('Y');
            $month = date('m');
            $query = $this->prepare('SELECT SUM(amount) AS total from transactions WHERE category_id = :categoryid AND id_user = :userid AND YEAR(date) = :year AND MONTH(date) = :month');
            $query->execute(['categoryid' => $categoryid, 'userid' => $userid, 'year' => $year, 'month' => $month]);
            
            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total == NULL) return 0;
            return $total;

        }catch(PDOException $e){
            error_log("**ERROR: TransactionsModel::getTotalByCategoryThisMonth: error: " . $e);
            return NULL;
        }
    }

    /**
     * Obtiene el total de amount de transactions basado en id de categoria
     */
    function getNumberOfExpensesByCategoryThisMonth($categoryid, $userid){
        try{
            $total = 0;
            $year = date('Y');
            $month = date('m');
            $query = $this->prepare('SELECT COUNT(id) AS total from transactions WHERE category_id = :categoryid AND id_user = :userid AND YEAR(date) = :year AND MONTH(date) = :month');
            $query->execute(['categoryid' => $categoryid, 'userid' => $userid, 'year' => $year, 'month' => $month]);

            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total == NULL) return 0;
            return $total;

        }catch(PDOException $e){
            return NULL;
        }
    }
}


?>