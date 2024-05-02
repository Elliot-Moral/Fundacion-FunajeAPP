<?php
  require_once('Libreries/Core/controllers.php');
  class saludybienestar extends Controllers{
    public function _construct(){
      parent::_construct();
    }

    public function saludybienestar($paramtro_fun){


      $this->vista->get_vista($this, 'saludybienestar' );
     
    }

    


  }
?>
