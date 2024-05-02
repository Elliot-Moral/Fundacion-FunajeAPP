<?php
  // require_once('Libreries/Core/Mysql.php');
  class home_model extends Mysql
  {
    public function __construct()
    {
      parent::__construct();
      // echo "<H3>mesaje desde el modelo HOME</H3>";
    }

    public function get_carrito($parametro){
      // echo "<br> datos get_carrito recibidos: ".$parametro;
      return "<br> Datos del carrito -metodo get_carrito de la clase home_model que recibe datos de home cotroller: ".$parametro;
    }

    public function set_usuario(string $nombre,int $telefono, string $email){

      $query_insert = 'INSERT INTO usuario(nombre, telefono, email) VALUES (?,?,?)';
      echo  "<br> datos desde enviados home ".$nombre." ".$telefono." ".$email." linea 18 <br>";
      $arr_data = array($nombre, $telefono, $email);
      print_r($arr_data);
      echo ' linea 21 ';
      $request_insert = $this->insert($query_insert, $arr_data);
      // echo "retorno de request_insert:  ".$request_insert;
      return $request_insert;
    }

    public function get_usuario($id)
    {
      $sql = "SELECT * FROM usuario WHERE id = $id"; //comilla simple no sirve
      $request = $this->select($sql);
      return $request;
    }

    public function update_usuario(int $id, string $nombre, int $telefono, string $email)
    {
      $sql = "UPDATE usuario SET nombre= ?, telefono= ?,  email=? WHERE id = $id"; //comilla simple no sirve
      $arr_data = array($nombre, $telefono, $email);
      $request = $this->update($sql, $arr_data);
      return $request;
    }

    public function get_usuarios()
    {
      $sql = "SELECT * FROM producto"; //comilla simple no sirve
      $request = $this->select_all($sql);
      return $request;
    }

    public function delete_usuarios($id)
    {
      $sql = "DELETE FROM usuario WHERE id = $id"; //comilla simple no sirve
      $request = $this->delete($sql);
      return $request;
    }
  }
?>
