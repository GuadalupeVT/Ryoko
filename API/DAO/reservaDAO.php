<?php
session_start();
  class ReservaDAO{
      //===============METODOS PARA ABCC ===============

      //------------ ALTAS ------------
      public function agregarReserva($id_reserva, $fecha_inicio, $fecha_fin, $id_habitacion, $id_cliente, $id_transporte, $total){
        require_once('../../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion(); 
        
        
        $sql = "INSERT INTO reserva VALUES (:id, :inicio, :fin, :id_hab, sha1(:id_cl), :id_tr, :tota_l)";
        
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
        require_once('../../../controlador/conexion_bd.php');
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
        require_once('../../../controlador/conexion_bd.php');
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
            $busqueda=$cc->db->query("Select * from reporte_reserva WHERE id_Cliente=sha1('".$_SESSION['usuario']."')");
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
            $busqueda=$cc->db->query("select * from reporte_reserva where fecha_inicio LIKE '%".$filtro."%' OR fecha_fin LIKE '%".$filtro."%' AND id_Cliente=sha1('".$_SESSION['usuario']."')");
         }
        $data=array();
        while($r=$busqueda->fetch(PDO::FETCH_ASSOC)){
            $data[]=$r;
        }
        /*Almacenamos el resultado de fetchAll en una variable*/
        echo json_encode(array("reservas"=>$data));
    }

    public function generarId(){
        require_once('../../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion();
        $sql = "SELECT COUNT(*) FROM reserva";        
        $result = $cc->db->prepare($sql); 
        $result->execute(); 
        $affected_rows = $result->fetchColumn(); 
        $id="RE0".$affected_rows;
        return ($id); 
    }

    //Para las altas de las reservas
    public function obtenerHotel($filtro){
        require_once('../../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion();
        $sql = "SELECT id_Hotel FROM hotel WHERE direccion_ciudad='".$filtro."'";        
        $result = $cc->db->prepare($sql); 
        $result->execute(); 
        $affected_rows = $result->fetchColumn(); 
        return ($affected_rows);
    }

    public function obtenerHabitacion($filtro){
        require_once('../../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion();
        $sql = "SELECT id_Habitaciones FROM habitaciones WHERE disponibilidad='Disponible' AND id_Hotel='".$filtro."'";        
        $result = $cc->db->prepare($sql); 
        $result->execute(); 
        $affected_rows = $result->fetchColumn(); 
        return ($affected_rows);
    }

    public function obtenerTransporte($filtro){
        require_once('../../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion();
        $sql = "SELECT id_transporte FROM transporte WHERE disponibilidad='Disponible' AND tipo='".$filtro."'";        
        $result = $cc->db->prepare($sql); 
        $result->execute(); 
        $affected_rows = $result->fetchColumn(); 
        return ($affected_rows);
    }

    public function obtenerTotal($id_habitacion, $id_transporte){
        require_once('../../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion();
        $sql = "SELECT costo FROM transporte WHERE id_Transporte='".$id_transporte."'";        
        $result = $cc->db->prepare($sql); 
        $result->execute(); 
        $costo_transporte = $result->fetchColumn(); 

        $sql = "SELECT costo FROM habitaciones WHERE id_Habitaciones='".$id_transporte."'";        
        $result = $cc->db->prepare($sql); 
        $result->execute(); 
        $costo_habitacion = $result->fetchColumn(); 

        $total=$costo_transporte+$costo_habitacion;
        return $total;
    }

    public function obtenerUsuario(){
        return $_SESSION['usuario'];
    }

  }
?>