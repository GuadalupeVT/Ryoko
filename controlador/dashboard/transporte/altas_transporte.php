<?php
 $id = $_POST['id'];
 $tipo = $_POST['tipo'];
 $linea = $_POST['linea'];
 $telefono = $_POST['telefono'];
 $costo= $_POST['costo'];
 $disponibilidad = $_POST['disponibilidad'];
 
//Verificacion de datos
 if(empty($id) || empty($linea) || empty($telefono) || empty($costo)){
     echo "No puede dejar campos vacios";
     
 }else{
     require_once("../../../modelo/DAO/transporteDAO.php"); 

    $tDAO = new TransporteDAO();
         //Se agrega usuario y cliente
         $agregar=$tDAO->agregarTransporte($id,$tipo,$linea,$telefono,$costo,$disponibilidad);
        
         if($agregar===1){
             echo "Registrado";
         }else if($agregar===0){
             echo "Error";
         }  
 }

?>