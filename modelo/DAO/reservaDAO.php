<?php
session_start();
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
            return 1;
        }  else{
            return 0;
        }
        
       
       
      }//agregar

      //------------ BAJAS ------------
      public function eliminarReserva($id_reserva){
        $cc = ConexionBD::getConexion(); 
        $sql= "DELETE FROM reserva WHERE id_Reserva=:id;";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_reserva); 
        if($result->execute($params)){
            return 1;
        }  else{
            return 0;
        }
    }//eliminar


    //------------ MODIFICAR ------------
    public function modificarReserva($id_reserva, $fecha_inicio, $fecha_fin){
        $cc = ConexionBD::getConexion();
        $sql= "UPDATE reserva SET fecha_inicio=:inicio, fecha_fin=:fin WHERE id_reserva=:id;";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_reserva, ':inicio' => $fecha_inicio, ':fin'=> $fecha_fin); 
        if($result->execute($params)){
            return 1;
        }  else{
            return 0;
        }
    }//modificar



    public function consultarReservas(){
        require_once('../../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion();

        if($_SESSION['usuario']=='admin'){
           $busqueda=$cc->db->query("Select * from reporte_reserva");
        }else{
            $busqueda=$cc->db->query("Select * from reporte_reserva where id_Usuario='".$_SESSION['usuario']."'");
        }
        $data=array();
        while($r=$busqueda->fetch(PDO::FETCH_ASSOC)){
            $data[]=$r;
        }
        /*Almacenamos el resultado de fetchAll en una variable*/
        echo json_encode(array("reservas"=>$data));
    }

    public function consultarReservasFiltro($filtro){
        require_once('../../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion();
        if($_SESSION['usuario']=='admin'){
            $busqueda=$cc->db->query("Select * from reporte_reserva where tipo LIKE '%".$filtro."%' OR disponibilidad LIKE '%".$filtro."%'");
         }else{
            $busqueda=$cc->db->query("select * from reporte_reserva where tipo LIKE '%".$filtro."%' OR disponibilidad LIKE '%".$filtro."%' AND id_Usuario='".$_SESSION['usuario']."'");
       
        $data=array();
        while($r=$busqueda->fetch(PDO::FETCH_ASSOC)){
            $data[]=$r;
        }
        /*Almacenamos el resultado de fetchAll en una variable*/
        echo json_encode(array("habitaciones"=>$data));
    }
}

    public function generarId(){
        require_once('../../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion();
        $sql = "SELECT COUNT(*) FROM reservas";        
        $result = $cc->db->prepare($sql); 
        $result->execute(); 
        $affected_rows = $result->fetchColumn(); 
        $id="RE0".$affected_rows;
        echo ($id); 
    }

  }
?>