<?php
  require_once('../../controlador/conexion_bd.php');


  class TransporteDAO{
      //===============METODOS PARA ABCC ===============

      //------------ ALTAS ------------
      public function agregarTransporte($id_transporte, $tipo, $linea, $telefono, $costo, $disponibilidad){
        $cc = ConexionBD::getConexion(); 
        
        
        $sql = "INSERT INTO transporte VALUES (:id, :tp, :ln, :tel, :cost, :disp";
        
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=>$id_transporte, ':tp'=>$tipo, ':ln'=>$linea, ':tel'$telefono, ':cost'=>$costo, ':disp'=>$disponibilidad); 
        if($result->execute($params)){
            echo "Insertado";
        }  else{
            echo"No se inserto :(";
        }
        
       
       
      }//agregar

      //------------ BAJAS ------------
      public function eliminarTransporte($id_transporte){
        $cc = ConexionBD::getConexion(); 
        $sql= "DELETE FROM transporte WHERE id_Transporte=:id;";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_transporte); 
        if($result->execute($params)){
            echo "Se elimino";
        }  else{
            echo "No se elimino";
        }
    }//eliminar


    //------------ MODIFICAR ------------
    public function modificarTransporte($id_transporte, $tipo, $linea, $telefono, $costo, $disponibilidad){
        $cc = ConexionBD::getConexion();
        $sql= "UPDATE transporte SET tipo=:tp, linea=:linea, telefono=:tel, costo=:cost, disponibilidad=:disp WHERE id_Transporte=:id;";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=>$id_transporte, ':tp'=>$tipo, ':ln'=>$linea, ':tel'$telefono, ':cost'=>$costo, ':disp'=>$disponibilidad);  
        if($result->execute($params)){
            echo "Se modifico";
        }  else{
            echo "No se modifico";
        }
    }//modificar

    public void consultarTransporte(){

    }

  }
?>