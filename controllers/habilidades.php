<?php
  require_once('Libreries/Core/controllers.php');
  class habilidades extends Controllers{
    public function _construct(){
      parent::_construct();
    }

    public function habilidades($paramtro_fun){


      $this->vista->get_vista($this, 'habilidades' );
     
    }

    


  }
?>
