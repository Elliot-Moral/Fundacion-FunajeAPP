<?php
  require_once('Libreries/Core/controllers.php');
  class soyimportante extends Controllers{
    public function _construct(){
      parent::_construct();
    }

    public function soyimportante($paramtro_fun){


      $this->vista->get_vista($this, 'soyimportante' );
     
    }

    


  }
?>
