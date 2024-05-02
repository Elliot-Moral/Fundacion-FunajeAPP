<?php
  require_once('Libreries/Core/Mysql.php');
  class configuracion_model extends Mysql
  {
    public function __construct()
    {
      parent::__construct();
      // echo "<H3>mesaje desde el modelo HOME</H3>";
    }

    #================================= METODOS ================================
    public function get_eventos(){

      $sql = "SELECT * FROM agenda";
      $request = $this->select_all($sql);
      return $request;
    }
    

    public function set_evento($titulo, $desc, $dia, $mes, $ruta_img){
      $query_insert = 'INSERT INTO agenda (tit_agen, desc_agen, dia_agen, mes_agen, img_agen) VALUES (?,?,?,?,?)';

      $arr_data = array($titulo, $desc, $dia, $mes, $ruta_img);
      $request_insert = $this->insert($query_insert, $arr_data);
      return $request_insert;
    }

    public function delete_evento($id){
      $sql = "DELETE FROM agenda WHERE id_agen = $id";
      $request = $this->delete($sql);
      return $request;
    }


    //===== Actividades ======
    public function get_actividad(){

      $sql = "SELECT * FROM actividades";
      $request = $this->select_all($sql);
      return $request;
    }
    public function set_activiad($titulo, $desc, $ruta_img){
      $query_insert = 'INSERT INTO actividades (tit_act, desc_act, img_act) VALUES (?,?,?)';

      $arr_data = array($titulo, $desc, $ruta_img);
      $request_insert = $this->insert($query_insert, $arr_data);
      return $request_insert;
    }

    public function update_activiad($id, $titulo, $desc, $ruta_img){

      $request_update = null;

      if(!$ruta_img){

        // sin img
        $sql = "UPDATE actividades SET tit_act=?, desc_act= ? WHERE id_act = $id";
        $arr_data = array($titulo, $desc);
        $request_update = $this->update($sql, $arr_data);

      }else{
        // con img
        $sql = "UPDATE actividades SET tit_act=?, desc_act= ?, img_act=? WHERE id_act = $id";
        $arr_data = array($titulo, $desc, $ruta_img);
        $request_update = $this->update($sql, $arr_data);

      }

      return $request_update;
    }


    public function delete_actividad($id){
      $sql = "DELETE FROM actividades WHERE id_act = $id";
      $request = $this->delete($sql);
      return $request;
    }

  }
?>
