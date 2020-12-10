<?php
  require_once('../../controlador/conexion_bd.php');


  class ReservaDAO{
      //===============METODOS PARA ABCC ===============

      //------------ ALTAS ------------
      public function agregarReserva($id_reserva, $fecha_inicio, $fecha_fin, $id_habitacion, $id_cliente, $id_transporte, $total){
        $cc = ConexionBD::getConexion(); 
        
        
        $sql = "INSERT INTO reserva VALUES (:id, :inicio, :fin, :id_hab, :id_cl, :id_tr, :tota_l)";
        
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_reserva, ':inicio' => $fecha_inicio, ':fin'=> $fecha_fin, ':id_hab'=> $id_habitacion, ':id_cl'=>$id_cliente, ':id_tr'=>$id_transporte, ':tota_l'=>$total); 
        if($result->execute($params)){
            echo "Insertado";
        }  else{
            echo"No se inserto :(";
        }
        
       
       
      }//agregar

      //------------ BAJAS ------------
      public function eliminarReserva($id_reserva){
        $cc = ConexionBD::getConexion(); 
        $sql= "DELETE FROM reserva WHERE id_Reserva=:id;";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_reserva); 
        if($result->execute($params)){
            echo "Se elimino";
        }  else{
            echo "No se elimino";
        }
    }//eliminar


    //------------ MODIFICAR ------------
    public function modificarReserva($id_reserva, $fecha_inicio, $fecha_fin, $id_habitacion, $id_cliente, $id_transporte, $total){
        $cc = ConexionBD::getConexion();
        $sql= "UPDATE reserva SET fecha_inicio=:inicio, fecha_fin=:fin, id_Habitacion=:id_hab, id_Cliente=:id_cl, id_Transporte=:id_tr, total=:tota_l WHERE id_reserva=:id;";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_reserva, ':inicio' => $fecha_inicio, ':fin'=> $fecha_fin, ':id_hab'=> $id_habitacion, ':id_cl'=>$id_cliente, ':id_tr'=>$id_transporte, ':tota_l'=>$total); 
        if($result->execute($params)){
            echo "Se modifico";
        }  else{
            echo "No se modifico";
        }
    }//modificar

  }
?>