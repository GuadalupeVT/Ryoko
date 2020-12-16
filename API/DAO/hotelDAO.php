<?php

  class HotelDAO{
      
      //===============METODOS PARA ABCC ===============

      //------------ ALTAS ------------
      public function agregarHotel($id_hotel, $nombre, $categoria, $telefono, $dir_calle,$dir_num, $dir_ciudad){
        require_once('conexion/conexion.php');

        $cc = ConexionBD::getConexion(); 
        
        
        $sql = "INSERT INTO hotel VALUES (:id, :nom, :cat, :tel, :calle, :num, :ciudad)";
        

        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_hotel, ':nom'=>$nombre, ':cat'=>$categoria, ':tel'=>$telefono, ':calle'=>$dir_calle, ':num'=>$dir_num, ':ciudad'=>$dir_ciudad); 
        return $result->execute($params);
        
       
       
      }//agregar

      //------------ BAJAS ------------
      public function eliminarHotel($id_transporte){
        require_once('conexion/conexion.php');
        $cc = ConexionBD::getConexion(); 
        $sql= "DELETE FROM hotel WHERE id_Hotel=:id;";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_transporte); 
        if($result->execute($params)){
            return 1;
        }  else{
            return 0;
        }
    }//eliminar


    //------------ MODIFICAR ------------
    public function modificarHotel($id_hotel, $nombre, $categoria, $telefono, $dir_calle,$dir_num, $dir_ciudad){
        require_once('conexion/conexion.php');

        $cc = ConexionBD::getConexion();
        $sql= "UPDATE hotel SET nombre=:nom, categoria=:cat, telefono=:tel, direccion_calle=:calle, direccion_numero=:num, direccion_ciudad=:ciudad  WHERE id_Hotel=:id;";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_hotel, ':nom'=>$nombre, ':cat'=>$categoria, ':tel'=>$telefono, ':calle'=>$dir_calle, ':num'=>$dir_num, ':ciudad'=>$dir_ciudad); 
        if($result->execute($params)){
            return 1;
        }  else{
            return 0;
        }
    }//modificar

    public function consultarHoteles(){
        require_once('conexion/conexion.php');
        $cc = ConexionBD::getConexion();
        
            $busqueda=$cc->db->query("Select * from hotel");
        

        $data=array();
        while($r=$busqueda->fetch(PDO::FETCH_ASSOC)){
            $data[]=$r;
        }
        /*Almacenamos el resultado de fetchAll en una variable*/
        echo json_encode(array("hoteles"=>$data));
    }

    public function consultarHotelesfiltro($filtro){
        require_once('conexion/conexion.php');
        $cc = ConexionBD::getConexion();

        
            $busqueda=$cc->db->query("select * from hotel where nombre LIKE '%".$filtro."%' AND direccion_ciudad LIKE '%".$filtro."%'");
       
        $data=array();
        while($r=$busqueda->fetch(PDO::FETCH_ASSOC)){
            $data[]=$r;
        }
        /*Almacenamos el resultado de fetchAll en una variable*/
        echo json_encode(array("hoteles"=>$data));
    }

    public function generarId(){
        require_once('conexion/conexion.php');
        $cc = ConexionBD::getConexion();
        $sql = "SELECT COUNT(*) FROM hotel";        
        $result = $cc->db->prepare($sql); 
        $result->execute(); 
        $affected_rows = $result->fetchColumn(); 
        $id="HT0".$affected_rows;
        echo ($id); 
    }
    
    public function obtenerId(){
        require_once('conexion/conexion.php');
        $cc = ConexionBD::getConexion();
        $sql = "SELECT * FROM hotel WHERE disponibilidad='Disponible'";        
        $busqueda = $cc->db->query($sql); 
        $data=array();
        while($r=$busqueda->fetch(PDO::FETCH_ASSOC)){
            $data[]=$r;
        }
        /*Almacenamos el resultado de fetchAll en una variable*/
        echo json_encode(array("id"=>$data));    
    }
    
  }
  
 