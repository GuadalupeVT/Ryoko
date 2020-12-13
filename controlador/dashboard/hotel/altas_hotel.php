<?php
 $id = $_POST['id'];
 $nombre = $_POST['nombre'];
 $categoria = $_POST['categoria'];
 $telefono = $_POST['telefono'];
 $calle= $_POST['calle'];
 $numero = $_POST['numero'];
 $ciudad=$_POST['ciudad'];
 
//Verificacion de datos
 if(empty($id) || empty($nombre) || empty($telefono) || empty($calle) || empty($numero) || empty($ciudad)){
     echo "No puede dejar campos vacios";
     
 }else{

if(strlen($telefono)!=10 || is_numeric($telefono)==false || is_numeric($numero)==false || is_numeric($numero)==false){
    echo "Datos incorrectos!";

}else{
     require_once("../../../modelo/DAO/HotelDAO.php"); 

    $tDAO = new HotelDAO();
         //Se agrega usuario y cliente
         $agregar=$tDAO->agregarHotel($id,$nombre,$categoria,$telefono,$calle,$numero,$ciudad);
        
         if($agregar===1){
             echo "Registrado";
         }else if($agregar===0){
             echo "Error";
         }  
 }
}

?>