<?php
  class Controllers
  {

    public function __construct()//primer metodo que se ejecuta y se debe llamar de la clase que hija
    {
      $this->vista = new Vista();
      $this->load_model();
      // echo '<br> HOLA desde constructor cotrollers';

    }

    #================================= METODOS ================================
    
    public function load_model()//para que este metodo se ejecute hay que llamarlo en el costructor
    {
      //home_model.php
      $model = get_class($this).'_model'; //estoy capturando la clase que esta esta heredandoa esta esta clase
      $rute_class = 'Models/'.$model.'.php';

      if(file_exists($rute_class))
      {
        require_once($rute_class);
        $this->model = new $model();
        // echo '<br> si existe el modelo';

      }else{
        echo '<br> no existe el modelo';
      }

    }
  }


?>
