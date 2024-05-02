<?php
  require_once('Libreries/Core/controllers.php');
  class apoyar extends Controllers{
    public function _construct(){
      parent::_construct();
    }

    public function apoyar($paramtro_fun){


      $this->vista->get_vista($this, 'apoyar' );
     
    }

    


  }
?>
