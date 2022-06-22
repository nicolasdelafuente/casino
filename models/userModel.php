<?php

class UserModel extends Model implements IModel{

  private $id;
  private $username;
  private $name;
  private $role;
  private $password;

  public function __construct(){
    error_log('USERMODEL::CONSTRUCT-> inicio de UsernModel');
    parent::__construct();

    $this->username = '';
    $this->name = '';
    $this->role = '';
    $this->password = '';      
  }

  public function save(){
    try{
      $query = $this->prepare('INSERT INTO usuarios (_usuario, nombre_usuario, rol_usuario, password_usuario) VALUES(:username, :name, :role, :password');
      $query->execute([
          'username'  => $this->username,
          'name'      => $this->name,
          'role'      => $this->role,
          'password'  => $this->password
          ]);
      return true;
    }catch(PDOException $e){
      error_log('USERMODEL::save-> PDOException: '. $e);
      return false;
    }
  } 

  public function getAll(){
    $items = [];

    try{
      $query = $this->query('SELECT * FROM usuarios');

      while($p = $query->fetch(PDO::FETCH_ASSOC)){
          $item = new UserModel();
          $item->setId($p['id']);
          $item->setUsername($p['username']);
          $item->setName($p['name']);
          $item->setRole($p['role']);
          $item->setPassword($p['password'], false);       
          
          array_push($items, $item);
      }
      return $items;

      }catch(PDOException $e){
        error_log('USERMODEL::getAll-> PDOException: '. $e);
        echo $e;
      }
  }

  public function getItem($id){
    try{
      $query = $this->prepare('SELECT * FROM usuarios WHERE id_usuario = :id');
      $query->execute([ 'id' => $id]);
      $user = $query->fetch(PDO::FETCH_ASSOC);

      $this->id = $user['id'];
      $this->username = $user['username'];
      $this->name = $user['name'];
      $this->role = $user['role'];
      $this->password = $user['password'];

      return $this;
    }catch(PDOException $e){
      error_log('USERMODEL::getItem-> PDOException: '. $e);
        return false;
    }
  }

  public function delete($id){
    try{
      $query = $this->prepare('DELETE FROM usuarios WHERE id_usuario = :id');
      $query->execute([ 'id' => $id]);
      return true;
    }catch(PDOException $e){
      error_log('USERMODEL::delete-> PDOException: '. $e);
      return false;
    }
  }

  public function update(){
    try{
      $query = $this->prepare('UPDATE usuarios SET username_usuario = :username, nombre_usuario = :name, password_usuario = :password  WHERE id_usuario = :id');
      $query->execute([
          'id'        => $this->id,
          'username' => $this->username,
          'name' => $this->name,
          'password' => $this->password,
          ]);
      return true;
    }catch(PDOException $e){
      error_log('USERMODEL::update-> PDOException: '. $e);
      return false;
    }
  }

  public function exists($username){
    try{
      $query = $this->prepare('SELECT username_usuario FROM usuarios WHERE username_usuario = :username');
      $query->execute( ['username' => $username]);
      
      if($query->rowCount() > 0){
          return true;
      }else{
          return false;
      }
    }catch(PDOException $e){
      error_log('USERMODEL::save-> PDOException: '. $e);
      return false;
    }
  }

  public function from($array){
      $this->id = $array['id'];
      $this->username = $array['username'];
      $this->password = $array['password'];
      $this->role = $array['role'];
      $this->budget = $array['budget'];
      $this->photo = $array['photo'];
      $this->name = $array['name'];
  }

  private function getHashedPassword($password){
    return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
  }

  
  public function setId($id){             $this->id = $id;}  
  public function setUsername($username){     $this->username = $username;}
  public function setName($name){         $this->name = $name;}
  public function setRole($role){         $this->role = $role;}
  public function setPassword($password, $hash = true){ 
    if($hash){
      $this->password = $this->getHashedPassword($password);
    }else{
      $this->password = $password;
    }
  }
  public function getId(){        return $this->id;}
  public function getUsername(){  return $this->username;}
  public function getName(){      return $this->name;}  
  public function getRole(){      return $this->role;} 
  public function getPassword(){  return $this->password;}
}

?>