<?php

  class TransporteDAO{
      //===============METODOS PARA ABCC ===============

      //------------ ALTAS ------------
      public function agregarTransporte($id_transporte, $tipo, $linea, $telefono, $costo, $disponibilidad){
        include_once('../../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion();    
        $sql = "INSERT INTO transporte VALUES (:id, :tp, :ln, :tel, :cost, :disp)"; 
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=>$id_transporte, ':tp'=>$tipo, ':ln'=>$linea, ':tel'=>$telefono, ':cost'=>$costo, ':disp'=>$disponibilidad); 
        if($result->execute($params)){
            return 1;
        }  else{
            return 0;
        }
        
       
       
      }//agregar

      //------------ BAJAS ------------
      public function eliminarTransporte($id_transporte){
        include_once('../../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion(); 
        $sql= "DELETE FROM transporte WHERE id_Transporte=:id;";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_transporte); 
        if($result->execute($params)){
            return 1;
        }  else{
            return 0;
        }
    }//eliminar


    //------------ MODIFICAR ------------
    public function modificarTransporte($id_transporte, $tipo, $linea, $telefono, $costo, $disponibilidad){
        include_once('../../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion();
        $sql= "UPDATE transporte SET tipo=:tp, linea=:ln, telefono=:tel, costo=:cost, disponibilidad=:disp WHERE id_Transporte=:id;";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=>$id_transporte, ':tp'=>$tipo, ':ln'=>$linea, ':tel'=>$telefono, ':cost'=>$costo, ':disp'=>$disponibilidad); 
        if($result->execute($params)){
            return 1;
        }  else{
            return 0;
        }
    }//modificar

    public function consultarTransportes(){
        require_once('../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion();
        $busqueda=$cc->db->query("Select * from transporte");
        /*Almacenamos el resultado de fetchAll en una variable*/
        return $arrDatos=$busqueda->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultarTransporte_id($id){
        include_once('../../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion(); 
        $result = $cc->db->prepare("Select * from transporte WHERE id_Transporte=:id");
        $params = array(':id'=>$id);
        $result->execute($params);
        /*Almacenamos el resultado de fetchAll en una variable*/
        return $result -> fetchAll(PDO::FETCH_OBJ); 
    }

  }
?>