<?php

  class Vista{#para utilizar esta clase vamos al controlador
    public function get_vista($controlador, $vista, $data="")
    #data vacion en caso de no neesitar enviar algo a la vista y que
    #no de error
    {
      $controlador = get_class($controlador);
      # echo '<br> la clase que resive la clase vista es: '.$controlador;
      # echo '<br> segundo parametro de get_vista de la clase vista es: '.$vista;

      #validacion
      if ($controlador == 'home') {
        $vista = VISTAS.$vista.'.html';
      }else {
        $vista = VISTAS.$controlador.'/'.$vista.'.html';
        # echo '<br> la variable vista tiene'.$vista ;
      }
      require_once($vista);
    }
  }
?>
