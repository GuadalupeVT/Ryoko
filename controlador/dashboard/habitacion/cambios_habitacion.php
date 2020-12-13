<?php
$id = $_POST['id'];
$costo = $_POST['costo'];
$tipo = $_POST['tipo'];
$id_Hotel = $_POST['id_hotel'];
$disponibilidad= $_POST['disponibilidad'];
 
 
//Verificacion de datos
 if(empty($id) || empty($costo) || empty($tipo) || empty($id_Hotel) || empty($disponibilidad) ){
     echo "No puede dejar campos vacios";
     
 }else{

if(is_numeric($costo)==false){
    echo "Datos incorrectos!";

}else{
     require_once("../../../modelo/DAO/habitacionDAO.php"); 

    $tDAO = new HabitacionDAO();
         //Se agrega usuario y cliente
         $agregar=$tDAO->modificarHabitacion($id,$costo,$tipo,$id_Hotel,$disponibilidad);
        
         if($agregar===1){
            echo "Se modifico registro";
        }else if($agregar===0){
            echo "Error";
        }  
 }
}

?>