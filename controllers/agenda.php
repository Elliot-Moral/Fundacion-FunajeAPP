<?php
  require_once('Libreries/Core/controllers.php');
  class agenda extends Controllers{
    public function _construct(){
      parent::_construct();
    }

    public function agenda($paramtro_fun){


      $this->vista->get_vista($this, 'agenda' );
     
    }

 #================================= METODOS ================================
    #comunicaion con EL MODELO>>>>>>>>>>>>>
    public function listar_agenda(){
      $data = $this->model->get_agenda();
      $j_data = json_encode($data);
      echo $j_data;
    }
    #esta funcion me ayuda a cargarme en la vista los datos o clientes que selecione de la tabla.
      // public function obtener_cedula_cliente(string $cedula){
      //   $data = $this->model->get_cliente($cedula);
      //   return $data;
      // }

      // public function save_cliente($nombres, $apellidos, $telefono, $direccion, $email, $genero, $cedula, $departamento, $municipio, $h_btn_credito, $tipo_credito, $credito){
      //   $data = $this->model->set_cliente($nombres, $apellidos, $telefono, $direccion, $email, $genero, $cedula, $departamento, $municipio, $h_btn_credito, $tipo_credito, $credito);
      //   return $data;
      // }

      // public function controlador_update_cliente($nombres, $apellidos, $telefono, $direccion, $email, $genero, $cedula, $departamento, $municipio, $h_btn_credito, $tipo_credito, $credito){
      //   $data = $this->model->update_cliente($nombres, $apellidos, $telefono, $direccion, $email, $genero, $cedula, $departamento, $municipio, $h_btn_credito, $tipo_credito, $credito);
      //   return $data;
      // }

      // public function borrar_cliente(string $cedula){
      //   $data = $this->model->delete_cliente($cedula);
      //   return $data;
      // }


    #comunicaion con la VISTA>>>>>>>>>>>>> 
    #funcion para que me traiga los datos del cliente al cliquear la tabla y mostrarlos en el formulario
    // public function recibir_cedula_cliente(){
    //   $cedula_cliente = $_POST['cedula_cliente'];

    //     if( $cedula_cliente == '')
    //     {
    //       echo json_encode('error');
    //     }else
    //     { 
    //       $data = $this->obtener_cedula_cliente($cedula_cliente);
    //       echo json_encode($data);
    //     }
    // }


    #recibir datos del formulario para guardar  un cliente
    //  public function guardar_cliente(){

    //   $nombres = $_POST['nombres']; #n_cli 
    //   $apellidos = $_POST['apellidos'];#ape_cli 
    //   $telefono = $_POST['telefono'];#tel_cli 
    //   $direccion = $_POST['direccion'];#dire_cli 
    //   $email = $_POST['email'];#emai_cli
    //   $genero = $_POST['genero'];#gen_cli
    //   $cedula = $_POST['cedula'];#cc_cli 
    //   $departamento = $_POST['departamento'];#depar_cli 
    //   $municipio = $_POST['municipio'];#muni_cli 
    //   $h_btn_credito = $_POST['h_creditos']; #hcred_cli
    //   $tipo_credito = $_POST['tp_credito']; #tip_cli
    //   $credito = $_POST['credito']; #cred_cli

    //   if($nombres == '' || $apellidos == '' || $telefono == '' || $direccion == '' || $email == '' || $cedula == ''){
    //     echo json_encode('error');    
    //   }else{
  
    //     try {
    //       $data = $this->save_cliente($nombres, $apellidos, $telefono, $direccion, $email, $genero, $cedula, $departamento, $municipio, $h_btn_credito, $tipo_credito, $credito);
    //       echo json_encode('correcto');
    
    //       } catch (Exception $e) {
    //         $arr_mensaje['ya_existe'] = $e;
    //         echo json_encode('ya_existe');
    //       }
    //   }

    // }

    #recibir datos del formulario para actualizar un cliente
    // public function actualizar_cliente(){
      // $id_cliente = $_POST['id_cliente']; #id_cli ////
    //   $nombres = $_POST['nombres']; #n_cli 
    //   $apellidos = $_POST['apellidos'];#ape_cli 
    //   $telefono = $_POST['telefono'];#tel_cli 
    //   $direccion = $_POST['direccion'];#dire_cli 
    //   $email = $_POST['email'];#emai_cli
    //   $genero = $_POST['genero'];#gen_cli
    //   $cedula = $_POST['cedula'];#cc_cli 
    //   $departamento = $_POST['departamento'];#depar_cli 
    //   $municipio = $_POST['municipio'];#muni_cli 
    //   $h_btn_credito = $_POST['h_creditos']; #hcred_cli
    //   $tipo_credito = $_POST['tp_credito']; #tip_cli
    //   $credito = $_POST['credito']; #cred_cli

    //   if($nombres == '' || $apellidos == '' || $telefono == '' || $direccion == '' || $email == '' || $cedula == ''){
    //     echo json_encode('error');    
      
    //   }else{
    //     try {
    //       $data = $this->controlador_update_cliente($nombres, $apellidos, $telefono, $direccion, $email, $genero, $cedula, $departamento, $municipio, $h_btn_credito, $tipo_credito, $credito);
    //       echo json_encode('correcto');
          
    //       } catch (Exception $e) {
    //         $arr_mensaje['dont_can'] = $e;
    //         echo json_encode($e);
    //       }
    //   }
  
    // }

    // public function recibir_cedula_para_borrar(){
    //   $cedula = $_POST['cedula'];#cc_cli
    //   if( $cedula == '')
    //   {
    //     echo json_encode('error');
    //   }else
    //   { 
    //     $data = $this->borrar_cliente($cedula);
    //     echo json_encode($data);
    //   } 
    // }

  }
?>
