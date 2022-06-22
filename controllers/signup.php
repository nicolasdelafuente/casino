<?php

include_once 'models/userModel.php';

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

    function newUser(){
      if($this->existPOST(['username', 'password'])){
          
        $username = $this->getPost('username');
        $password = $this->getPost('password');
        
        //validate data
        if($username == '' || empty($username) || $password == '' || empty($password)){
          // error al validar datos
          //$this->errorAtSignup('Campos vacios');
          $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
        }

        $user = new UserModel();
        $user->setUsername($username);
        $user->setRole("user");
        $user->setPassword($password);
        
        if($user->exists($username)){
          //$this->errorAtSignup('Error al registrar el usuario. Elige un nombre de usuario diferente');
          $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS]);
          //return;
        }else if($user->save()){
          //$this->view->render('login/index');
          $this->redirect('', ['success' => SuccessMessages::SUCCESS_SIGNUP_NEWUSER]);
        }else{
          /* $this->errorAtSignup('Error al registrar el usuario. Inténtalo más tarde');
          return; */
          $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER]);
        }
      }else{
        // error, cargar vista con errores
        //$this->errorAtSignup('Ingresa nombre de usuario y password');
        $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER]);
      }
    }
  }

?>