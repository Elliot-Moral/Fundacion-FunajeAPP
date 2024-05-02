<?php
  require_once('Libreries/Core/controllers.php');
  class psicologia extends Controllers{
    public function _construct(){
      parent::_construct();
    }

    public function psicologia($paramtro_fun){


      $this->vista->get_vista($this, 'psicologia' );
     
    }

    


  }
?>
