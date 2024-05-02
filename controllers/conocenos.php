<?php
  require_once('Libreries/Core/controllers.php');
  class conocenos extends Controllers{
    public function _construct(){
      parent::_construct();
    }

    public function conocenos($paramtro_fun){


      $this->vista->get_vista($this, 'conocenos' );
     
    }

    


  }
?>
