<?php
 session_start();

  class HabitacionDAO{
      
      //===============METODOS PARA ABCC ===============

      //------------ ALTAS ------------
      public function agregarHabitacion($id_habitacion, $costo, $tipo, $id_Hotel,$disponibilidad){
        require_once('../../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion(); 
        $sql = "INSERT INTO habitaciones VALUES (:id, :ct, :tp, :id_h, :disp)";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_habitacion, ':ct'=>$costo, ':tp'=>$tipo, ':id_h'=>$id_Hotel, ':disp'=>$disponibilidad); 
        if($result->execute($params)){
            return 1;
        }  else{
            return 0;
        }
       
       
      }//agregar

      //------------ BAJAS ------------
      public function eliminarHabitacion($id_habitacion){
        include_once('../../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion(); 
        $sql= "DELETE FROM habitaciones WHERE id_Habitaciones=:id;";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_habitacion); 
        if($result->execute($params)){
            return 1;
        }  else{
            return 0;
        }
    }//eliminar


    //------------ MODIFICAR ------------
    public function modificarHabitacion($id_habitacion, $costo, $tipo, $id_Hotel,$disponibilidad){
        require_once('../../../controlador/conexion_bd.php');

        $cc = ConexionBD::getConexion();
        $sql= "UPDATE habitaciones SET costo=:ct, tipo=:tp, id_Hotel=:id_h, disponibilidad=:disp  WHERE id_Habitaciones=:id;";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_habitacion, ':ct'=>$costo, ':tp'=>$tipo, ':id_h'=>$id_Hotel, ':disp'=>$disponibilidad); 
        if($result->execute($params)){
            return 1;
        }  else{
            return 0;
        }
    }//modificar

    public function consultarHabitaciones(){
        require_once('../../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion();
            $busqueda=$cc->db->query("Select * from habitaciones");
        $data=array();
        while($r=$busqueda->fetch(PDO::FETCH_ASSOC)){
            $data[]=$r;
        }
        /*Almacenamos el resultado de fetchAll en una variable*/
        echo json_encode(array("habitaciones"=>$data));
    }

    public function consultarHabitacionesFiltro($filtro){
        require_once('../../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion();
            $busqueda=$cc->db->query("select * from habitaciones where tipo LIKE '%".$filtro."%' OR disponibilidad LIKE '%".$filtro."%'");
       
        $data=array();
        while($r=$busqueda->fetch(PDO::FETCH_ASSOC)){
            $data[]=$r;
        }
        /*Almacenamos el resultado de fetchAll en una variable*/
        echo json_encode(array("habitaciones"=>$data));
    }

    public function generarId(){
        require_once('../../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion();
        $sql = "SELECT COUNT(*) FROM habitaciones";        
        $result = $cc->db->prepare($sql); 
        $result->execute(); 
        $affected_rows = $result->fetchColumn(); 
        $id="HA0".$affected_rows;
        echo ($id); 
    }

    
    
  }
  
 