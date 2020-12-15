<?php
  include_once('Conexion/conexion_bd.php');

  class ClienteDAO{
      //===============METODOS PARA ABCC ===============

      //------------ ALTAS ------------
      public function agregarCliente($id_Cliente,$nombre,$primerAp,$segundoAp,$fechaNac,$telefono){
        $cc = ConexionBD::getConexion(); 
        $sql="INSERT INTO cliente VALUES(sha1(:id), :nomb, :pApellido, :sApellido, :fnac ,:tel);";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_Cliente, ':nomb'=>$nombre, ':pApellido'=>$primerAp, ':sApellido'=>$segundoAp, ':fnac'=>$fechaNac, ':tel'=>$telefono);   
        if($result->execute($params)){
            return 1;
        }  else{
            return 0;
        }

      }//agregar

      //------------ BAJAS ------------
      public function eliminarCliente($id_Cliente){
        $cc = ConexionBD::getConexion(); 
        $sql= "DELETE FROM cliente WHERE id_Cliente=sha1(:id);";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_Cliente);  
        if($result->execute($params)){
            echo "Eliminado";
        }  else{
            echo"No Eliminado :(";
        } 
        
    }//eliminar


    //------------ MODIFICAR ------------
    public function modificarCliente($id_Cliente,$nombre,$primerAp,$segundoAp,$fechaNac,$telefono){
        $cc = ConexionBD::getConexion(); 
        $sql= "UPDATE cliente SET nombre=:nomb, primerAp=:pApellido, segundoAp=:sApellido, FechaNac=:fnac, telefono=:tel WHERE id_Cliente=sha1(:id);";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_Cliente, ':nomb'=>$nombre, ':pApellido'=>$primerAp, ':sApellido'=>$segundoAp, ':fnac'=>$fechaNac, ':tel'=>$telefono);   
        if($result->execute($params)){
            echo "Modificado";
        }  else{
            echo"No se modifico :(";
        }

    }//modificar

  }
?>