<?php

  class View{

      function __construct(){
      }

      function render($nombre, $data = []){
        $this->d = $data;          
        error_log('VIEW::RENDER-> '. $nombre);

        require 'views/' . $nombre . '.php';
    }

  }

?>