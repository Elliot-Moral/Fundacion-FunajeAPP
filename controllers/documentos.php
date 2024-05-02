<?php
  require_once('Libreries/Core/controllers.php');
  class documentos extends Controllers{
    public function _construct(){
      parent::_construct();
    }

    public function documentos($paramtro_fun){


      $this->vista->get_vista($this, 'documentos' );
     
    }

    


  }
?>
