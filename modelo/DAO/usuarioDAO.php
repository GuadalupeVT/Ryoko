<?php
  require_once('../../controlador/conexion_bd.php');


  class UsuarioDAO{
      //===============METODOS PARA ABCC ===============

      //------------ ALTAS ------------
      public function agregarUsuario($usuario, $contraseña, $tipo){
        $cc = ConexionBD::getConexion(); 
        
        
        $sql = "INSERT INTO usuarios VALUES (sha1(:user), sha1(:cont), :tp)";
        

        $result = $cc->db->prepare($sql); 
        $params = array(':user'=> $usuario, ':cont'=>$contraseña, ':tp'=>$tipo); 
        if($result->execute($params)){
            echo "Insertado";
        }  else{
            echo"No se inserto :(";
        }
        
       
       
      }//agregar

      //------------ BAJAS ------------
      public function eliminarUsuario($correo){
        $cc = ConexionBD::getConexion(); 
        $sql= "DELETE FROM usuarios WHERE usuario=sha1(:user);";
        $result = $cc->db->prepare($sql); 
        $params = array(':user'=> $correo); 
        if($result->execute($params)){
            echo "Se elimino";
        }  else{
            echo "No se elimino";
        }
    }//eliminar


    //------------ MODIFICAR ------------
    public function modificarUsuario($correo,$contraseña,$tipo){
        $cc = ConexionBD::getConexion();
        $sql= "UPDATE usuarios SET contraseña=:cont, tipo=:tp WHERE usuario=sha1(:user);";
        $result = $cc->db->prepare($sql); 
        $params = array(':user'=> $correo, ':cont'=>$contraseña, ':tp'=>$tipo); 
        if($result->execute($params)){
            echo "Se modifico";
        }  else{
            echo "No se modifico";
        }
    }//modificar

  }
?>