<?php
  require_once('../../controlador/conexion_bd.php');


  class HotelDAO{
      //===============METODOS PARA ABCC ===============

      //------------ ALTAS ------------
      public function agregarHotel($id_hotel, $nombre, $categoria, $telefono, $dir_calle,$dir_num, $dir_ciudad, $dir_pais){
        $cc = ConexionBD::getConexion(); 
        
        
        $sql = "INSERT INTO hotel VALUES (:id, :nom, :cat, :tel, :calle, :num, :ciudad, :pais)";
        

        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_hotel, ':nom'=>$nombre, ':cat'=>$categoria, ':tel'=>$telefono, ':calle'=>$dir_calle, ':num'=>$dir_num, ':ciudad'=>$dir_ciudad, ':pais'=>$dir_pais); 
        if($result->execute($params)){
            echo "Insertado";
        }  else{
            echo"No se inserto :(";
        }
        
       
       
      }//agregar

      //------------ BAJAS ------------
      public function eliminarHotel($id_hotel){
        $cc = ConexionBD::getConexion(); 
        $sql= "DELETE FROM hotel WHERE id_hotel=:id;";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_hotel); 
        if($result->execute($params)){
            echo "Se elimino";
        }  else{
            echo "No se elimino";
        }
    }//eliminar


    //------------ MODIFICAR ------------
    public function modificarHotel($id_hotel, $nombre, $categoria, $telefono, $dir_calle,$dir_num, $dir_ciudad, $dir_pais){
        $cc = ConexionBD::getConexion();
        $sql= "UPDATE hotel SET nombre=:nom, categoria=:cat, telefono=:tel, direccion_calle=:calle, direccion_numero=:num, direccion_ciudad=:ciudad, direccion_pais=:pais WHERE id_hotel=:id;";
        $result = $cc->db->prepare($sql); 
        $params = array(':id'=> $id_hotel, ':nom'=>$nombre, ':cat'=>$categoria, ':tel'=>$telefono, ':calle'=>$dir_calle, ':num'=>$dir_num, ':ciudad'=>$dir_ciudad, ':pais'=>$dir_pais); 
        if($result->execute($params)){
            echo "Se modifico";
        }  else{
            echo "No se modifico";
        }
    }//modificar

    public function consultarHoteles(){
        require_once('../../controlador/conexion_bd.php');
        $cc = ConexionBD::getConexion();
        $busqueda=$cc->db->query("Select * from hotel");
        /*Almacenamos el resultado de fetchAll en una variable*/
        return $arrDatos=$busqueda->fetchAll(PDO::FETCH_OBJ);
    }

  }
 