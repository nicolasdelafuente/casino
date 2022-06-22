<?php

  interface IModel{
    
    public function save();
    public function getAll();
    public function getItem($id);
    public function delete($id);
    public function update();
    public function from($array);
  
  }

?>