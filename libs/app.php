<?php
  
  class App {

    function __construct() {
      $url = isset($_GET['url']) ? $_GET['url']: null;
      $url = rtrim($url, '/');
      $url = explode('/', $url);
      
      if(empty($url[0])){
        error_log('APP::CONSTRUCT-> No hay controlador especificado');
        $archivoController = 'controllers/login.php';
        require_once $archivoController;
        $controller = new Login();
        $controller->loadModel('login');
        $controller->render();
        return false;
      }

      error_log('APP::CONSTRUCT-> Controlador: '.$url[0]);
      $archivoController = 'controllers/' . $url[0] . '.php';

      if(file_exists($archivoController)){
        require_once $archivoController;

        // inicializar controlador
        $controller = new $url[0];
        $controller->loadModel($url[0]);

        if(isset($url[1])){
          if(method_exists($controller, $url[1])){
            error_log('APP::CONSTRUCT-> Modelo: '.$url[1]);
            if(isset($url[2])){
              //El método tiene parámetros
              //Obtener cantidad de parametros
              $nparam = sizeof($url) - 2;
              
              $params = [];

              for($i = 0; $i < $nparam; $i++){
                array_push($params, $url[$i + 2]);
              }

              //pasar al metodo   
              error_log('APP::CONSTRUCT->'. $controller .'/'. $url[1].'/'. $params);
              $controller->{$url[1]}($params);
            } else {
              error_log('APP::CONSTRUCT->'. $controller .'/'. $url[1]);
              $controller->{$url[1]}();    
            }
          }else{
            error_log('APP::CONSTRUCT-> Error, no existe método');
          }
        }else{
          error_log('APP::CONSTRUCT-> Se carga el método default');
          $controller->render();
        }
    }else{
      error_log('APP::CONSTRUCT-> Error, no existe el archivo.');
    }
  }
}

?>