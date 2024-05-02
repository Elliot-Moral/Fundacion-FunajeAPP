<?php
  require_once('Libreries/Core/controllers.php');
  class contacto extends Controllers{
    public function _construct(){
      parent::_construct();
    }

    public function contacto($paramtro_fun){


      $this->vista->get_vista($this, 'contacto' );
     
    }

    ///================  metodos ===============



    ///================  metodos con la vista ================
    public function recibir_formulario(){

      if (isset($_POST['nombre']) &&  isset($_POST['correo']) && isset($_POST['celular']) && isset($_POST['pais'])  && isset($_POST['mensaje'])) {
        
        // Obtener el valor del dato enviado desde el formulario
        $nombre = $_POST['nombre']; 
        $correo = $_POST['correo'];
        $celular = $_POST['celular'];
        $pais = $_POST['pais'];
        $mensaje = $_POST['mensaje'];


          // Configura los datos del correo electrónico
          $destinatario = "morales1996an@gmail.com"; // Reemplaza con tu dirección de correo electrónico
          $asunto = "Datos del formulario de la pagina web FUNAJE";

          // Construye el cuerpo del mensaje
          $cuerpoMensaje = "Nombre: $nombre\n";
          $cuerpoMensaje .= "Correo Electrónico: $correo\n";
          $cuerpoMensaje .= "Celular:\n$celular";
          $cuerpoMensaje .= "Pais:\n$pais";
          $cuerpoMensaje .= "Mensaje:\n$mensaje";


        try {

            // Envía el correo electrónico
            $resultado = mail($destinatario, $asunto, $cuerpoMensaje);

            // Verifica si el correo se envió con éxito
            if ($resultado) {
                echo json_encode("¡Gracias! Tu mensaje ha sido enviado correctamente.");
            } else {
                echo json_encode("Lo sentimos, ha ocurrido un error al enviar el mensaje. Por favor, inténtalo de nuevo más tarde.");
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
