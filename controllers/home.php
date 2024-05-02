<?php
  // require_once('Libreries/Core/controllers.php');
  class home extends Controllers{
    public function _construct(){
      parent::_construct();
    }

    public function home($paramtro_fun){ //se puede quitar el parametro ya que
      //este viene vacio desde el index
      // echo '<h1>Mensaje Desde El Controlador Home</h1>';
      // echo "<br>";
      // echo "<br> EL marametro recibido desde clase home metodo home capturado de la url por index.php es: ".$paramtro_fun;



      // //cargar la vista
      $this->vista->get_vista($this, 'home' );
      //data es array que contiene toda la informacion de nuetsra pagina

    }

    public function datos($paramtro_fun){
      echo "<br> EL marametro recibido es: ".$paramtro_fun;
    }

    public function carrito($paramtro_fun){
      echo "<br> datos del metodo carrito:".$paramtro_fun;
      $carrito = $this->model->get_carrito($paramtro_fun); //aca le estoy pasando el parametros
      //capturado de la url a el metodo get_carrito que esta en el modelo y que se alamcena en la variable carrito

      echo "<br>";
      //varlor retornado
      echo "<br> datos retornados del modelo get_carrito almacenado en variable metodo carrito de home: ".$carrito;

    }

    public function insertar(){
      echo "hola insertar";
      $data = $this->model->set_usuario('Andres', 3046605171, 'morales@moral.com');
      echo "<br>Ultimo dato insertado from class home: ";print_r($data);
    }

    public function ver_usuario($id){

      $data = $this->model->get_usuario($id);
      // echo "<br>Datos del usuario: ";print_r($data);
      // print_r($data);
     // header('Content-Type: aplicacion/json');
      
      echo json_encode($data);


    }

    public function actualizar_usuario(){
      $data = $this->model->update_usuario(5, 'ana', 314546564, 'ana@gmail.com');
      echo "<br>Datos del usuario actualizado: ";print_r($data);
    }

    public function ver_productos(){
      $data = $this->model->get_usuarios();
      // echo "<br>Datos de los usuarios son: ";
      // echo "<pre>";
      $j_data = json_encode($data);
      echo $j_data;
      // echo "</pre>";
    }

    public function borrar_usuario($id){
      $data = $this->model->delete_usuarios($id);
      echo "<br>Si es uno exitoso: ";
      print_r($data);

    }

     public function prueba_api(){
     header('Content-Type: aplicacion/json');
      $arrayName = array('ss','ss','asdasd');

      $datas['tag_page'] = 'Home';
      $datas['page_title'] = 'Pagina Principal';
      $datas['page_name'] = 'home';
      // $enero = {"name":"assd","ape":"moral","edad":"1449"};
      $ere = json_encode($datas);
      echo $ere;
      // $enero = {"name":"assd","ape":"moral","edad":"1449"};
      // $ere = json_encode($arrayName);
      // echo $ere;
      // print_r ($arrayName);
      // echo $enero;



    }


  }
?>
