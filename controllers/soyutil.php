<?php
  require_once('Libreries/Core/controllers.php');
  class soyutil extends Controllers{
    public function _construct(){
      parent::_construct();
    }

    public function soyutil($paramtro_fun){


      $this->vista->get_vista($this, 'soyutil' );
     
    }

    


  }
?>
