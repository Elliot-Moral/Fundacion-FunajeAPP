<?php

spl_autoload_register(function ($class){
  if(file_exists(LIBRERIAS.'Core/'.$class.'.php')){
    require_once(LIBRERIAS.'Core/'.$class.".php");
    // echo LIBRERIAS.'Core/'.$class.".php";
  }
});

?>
