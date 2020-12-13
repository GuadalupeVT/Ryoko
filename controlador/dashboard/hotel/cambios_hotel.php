<?php
 $id = $_POST['id'];
 $nombre = $_POST['nombre'];
 $categoria = $_POST['categoria'];
 $telefono = $_POST['telefono'];
 $calle= $_POST['calle'];
 $numero = $_POST['numero'];
 $ciudad=$_POST['ciudad'];
 
//Verificacion de datos
 if(empty($id) || empty($nombre) || empty($telefono) || empty($calle)){
     echo "No puede dejar campos vacios";
     
 }else{
     require_once("../../../modelo/DAO/HotelDAO.php"); 

    $tDAO = new HotelDAO();
         //Se agrega usuario y cliente
         $agregar=$tDAO->modificarHotel($id,$nombre,$categoria,$telefono,$calle,$numero,$ciudad);
        
         if($agregar===1){
            echo "Se modifico registro";
        }else if($agregar===0){
            echo "Error";
        }  
 }

?>