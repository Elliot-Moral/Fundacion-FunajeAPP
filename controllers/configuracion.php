<?php
  require_once('Libreries/Core/controllers.php');
  class configuracion extends Controllers{
    public function _construct(){
      parent::_construct();
    }

    public function configuracion($paramtro_fun){


       #validar si el usuario se la logeado
      session_start();
      
      if (!isset($_SESSION['id_usuario'])) {
        echo 'NO Tiene Acceso Al Sistema';
      }else{
        #cargar la vista!
        $this->vista->get_vista($this, 'configuracion' );
      }

     
    }

    #================================= METODOS ================================
    #comunicaion con EL MODELO>>>>>>>>>>>>>
    public function listar_eventos(){
      $data = $this->model->get_eventos();
      $j_data = json_encode($data);
      echo $j_data;
    }

    public function guardar_evento($titulo, $desc, $dia, $mes , $ruta_img){
      $data = $this->model->set_evento($titulo, $desc, $dia, $mes,  $ruta_img);
      return $data;
    }
    
    public function eliminar_por_id($id){
      $data = $this->model->delete_evento($id);
      $j_data = json_encode($data);
      echo $j_data;
    }
    
    
    //===== Actividades ======
    public function listar_actividad(){
      $data = $this->model->get_actividad();
      $j_data = json_encode($data);
      echo $j_data;
    }
    public function guardar_actividad($titulo, $desc, $ruta_img){
      $data = $this->model->set_activiad($titulo, $desc, $ruta_img);
      return $data;
    }
    

    public function actualizar_actividad($id, $titulo, $desc, $ruta_img){
      $data = $this->model->update_activiad($id, $titulo, $desc, $ruta_img);
      return $data;
    }

    public function eliminar_actividad_por_id($id){
      $data = $this->model->delete_actividad($id);
      $j_data = json_encode($data);
      echo $j_data;
    }

    #================================= METODOS para la vista ================================



    public function recibir_formulario(){

      if (isset($_POST['titulo']) &&  isset($_POST['desc']) && isset($_POST['dia']) && isset($_POST['mes'])  && isset($_FILES['img_evento'])) {
        // Obtener el valor del dato enviado desde el formulario
        $titulo = $_POST['titulo']; 
        $desc = $_POST['desc'];
        $dia = $_POST['dia'];
        $mes = $_POST['mes'];;
        $nombre_imagen = $_FILES['img_evento']['name'];
        $carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/funaje/media/agenda/';

        //agregar ruta a la imagen
        $ruta_img = "media/agenda/".$nombre_imagen;

        try {

          $data = $this->guardar_evento($titulo, $desc, $dia, $mes, $ruta_img);
          
          #mover la imagen a la carpeta funaje/media
          move_uploaded_file($_FILES['img_evento']['tmp_name'],$carpeta_destino.$nombre_imagen);
          
          echo json_encode($data);

          } catch (Exception $e) {
            $arr_mensaje['ya_existe'] = $e;
            echo json_encode($arr_mensaje);
          }

      } else {
          echo json_encode("Error: No se recibió ningún dato del formulario.");
      }

    }

    

    public function eliminar_evento(){
      
      if (isset($_POST['id']) &&  isset($_POST['name_img']) ) {
        // Obtener el valor del dato enviado desde el formulario
        $id = $_POST['id']; 
        $name = $_POST['name_img'];

        $carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/funaje/media/agenda/';


        try {

          $data = $this->eliminar_por_id($id);
          
          #BORRAR la imagen a la carpeta funaje/media
          $ruta_imagen_a_eliminar = $carpeta_destino . $name;

          if (file_exists($ruta_imagen_a_eliminar)) {

              // Verificar si el archivo existe antes de intentar eliminarlo
              if (unlink($ruta_imagen_a_eliminar)) {
                  // echo json_encode("La imagen ha sido eliminada correctamente.".$data);
              } else {
                echo json_encode("Error al intentar eliminar la imagen.");
              }

          } else {
            echo json_encode("La imagen que intentas eliminar no existe en el directorio.");
          }

          } catch (Exception $e) {
            $arr_mensaje['ya_existe'] = $e;
            echo json_encode($arr_mensaje);
          }

      } else {
          echo json_encode("Error: No se recibió ningún dato del formulario.");
      }

    }

    #================================= METODOS ACTIVIDADES ================================
    public function guardar_actividades(){

      if (isset($_POST['titulo_act']) &&  isset($_POST['desc_act'])  && isset($_FILES['file_act'])) {
        
        // Obtener el valor del dato enviado desde el formulario
        $titulo = $_POST['titulo_act']; 
        $desc = $_POST['desc_act'];
        $nombre_imagen = $_FILES['file_act']['name'];
        
        //agregar ruta a la imagen en la base de datos
        $carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/funaje/media/actividades/';
        $ruta_img = "media/actividades/".$nombre_imagen;

        try {

          $data = $this->guardar_actividad($titulo, $desc, $ruta_img);
          
          // #mover la imagen a la carpeta funaje/media
          move_uploaded_file($_FILES['file_act']['tmp_name'],$carpeta_destino.$nombre_imagen);
          
          echo json_encode("correcto");

          } catch (Exception $e) {
            $arr_mensaje['ya_existe'] = $e;
            echo json_encode($arr_mensaje);
          }

      } else {
          echo json_encode("Error: No se recibió ningún dato del formulario.");
      }

    }


    public function actualizar_actividades_con_img(){

      if (isset($_POST['id']) && isset($_POST['titulo']) && isset($_POST['desc']) && isset($_POST['img_act']) && isset($_FILES['file_act'])) {
        
        // Obtener el valor del dato enviado desde el formulario
        $id = $_POST['id'];
        $titulo = $_POST['titulo']; 
        $desc = $_POST['desc'];
        $name_img = $_POST['img_act'];
        $nombre_imagen = $_FILES['file_act']['name'];
        
        //agregar ruta a la imagen en la base de datos
        $carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/funaje/media/actividades/';

        // para la dba
        $ruta_img = "media/actividades/".$nombre_imagen;

        try {

          $data = $this->actualizar_actividad($id, $titulo, $desc, $ruta_img);

          #BORRAR la imagen a la carpeta funaje/actividades
          $ruta_imagen_a_eliminar = $carpeta_destino . $name_img;

          if (file_exists($ruta_imagen_a_eliminar)) {

              // Verificar si el archivo existe antes de intentar eliminarlo
              if (unlink($ruta_imagen_a_eliminar)) {
                  // echo json_encode("La imagen ha sido eliminada correctamente.".$data);
              } else {
                echo json_encode("Error al intentar eliminar la imagen.");
              }

          } else {
            echo json_encode("La imagen que intentas eliminar no existe en el directorio.");
          }
          
          // #mover la imagen a la carpeta funaje/actividades
          move_uploaded_file($_FILES['file_act']['tmp_name'],$carpeta_destino.$nombre_imagen);
          
          if($data){
            echo json_encode($data);
          }else{
            echo json_encode("error");
          }

          } catch (Exception $e) {
            $arr_mensaje['ya_existe'] = $e;
            echo json_encode($arr_mensaje);
          }

      } else {
          echo json_encode("Error: No se recibió ningún dato del formulario.");
      }

    }


    public function actualizar_actividades_sin_img(){

      if (isset($_POST['id']) && isset($_POST['titulo']) && isset($_POST['desc'])) {
        
        // Obtener el valor del dato enviado desde el formulario
        $id = $_POST['id'];
        $titulo = $_POST['titulo']; 
        $desc = $_POST['desc'];
        

        try {

          $data = $this->actualizar_actividad($id,$titulo, $desc, false);
          
          if($data){
            echo json_encode("correcto");
          }else{
            echo json_encode('Error');
          }

          } catch (Exception $e) {
            $arr_mensaje['ya_existe'] = $e;
            echo json_encode($arr_mensaje);
          }

      } else {
          echo json_encode("Error: No se recibió ningún dato del formulario.");
      }

    }


    public function eliminar_actividad(){
      
      if (isset($_POST['id']) &&  isset($_POST['name_img']) ) {
        // Obtener el valor del dato enviado desde el formulario
        $id = $_POST['id']; 
        $name = $_POST['name_img'];

        $carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/funaje/media/actividades/';


        try {

          $data = $this->eliminar_actividad_por_id($id);
          
          #BORRAR la imagen a la carpeta funaje/media
          $ruta_imagen_a_eliminar = $carpeta_destino . $name;

          if (file_exists($ruta_imagen_a_eliminar)) {

              // Verificar si el archivo existe antes de intentar eliminarlo
              if (unlink($ruta_imagen_a_eliminar)) {
                  // echo json_encode("La imagen ha sido eliminada correctamente.".$data);
              } else {
                echo json_encode("Error al intentar eliminar la imagen.");
              }

          } else {
            echo json_encode("La imagen que intentas eliminar no existe en el directorio.");
          }

          } catch (Exception $e) {
            $arr_mensaje['ya_existe'] = $e;
            echo json_encode($arr_mensaje);
          }

      } else {
          echo json_encode("Error: No se recibió ningún dato del formulario.");
      }

    }

  }
?>
