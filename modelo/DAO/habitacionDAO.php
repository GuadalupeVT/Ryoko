<?php
  require_once('../../controlador/conexion_bd.php');


  class HabitacionDAO{
      //===============METODOS PARA ABCC ===============

      //------------ ALTAS ------------
      public function agregarHabitacion($id_habitacion, $costo, $tipo, $id_hotel, $disponibilidad){
        $cc = ConexionBD::getConexion(); 
        
        
        $sql = "INSERT INTO habitaciones VALUES (:id, :cost, :tp, :id_ht, :disp )";
        

        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_habitacion, ':cost'=>$costo, ':tp'=>$tipo, ':id_ht'=>$id_hotel, 'disp'=>$disponibilidad); 
        if($result->execute($params)){
            echo "Insertado";
        }  else{
            echo"No se inserto :(";
        }
        
       
       
      }//agregar

      //------------ BAJAS ------------
      public function eliminarHabitacion($id_habitacion){
        $cc = ConexionBD::getConexion(); 
        $sql= "DELETE FROM habitaciones WHERE id_habitaciones=:id;";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_habitacion); 
        if($result->execute($params)){
            echo "Se elimino";
        }  else{
            echo "No se elimino";
        }
    }//eliminar


    //------------ MODIFICAR ------------
    public function modificarHabitacion($id_habitacion, $costo, $tipo, $id_hotel, $disponibilidad){
        $cc = ConexionBD::getConexion();
        $sql= "UPDATE habitaciones SET costo=:cost, tipo=:tp, id_hotel=:id_ht, disponibilidad=:disp WHERE id_habitaciones=:id;";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_habitacion, ':cost'=>$costo, ':tp'=>$tipo, ':id_ht'=>$id_hotel, 'disp'=>$disponibilidad);  
        if($result->execute($params)){
            echo "Se modifico";
        }  else{
            echo "No se modifico";
        }
    }//modificar

  }
?>