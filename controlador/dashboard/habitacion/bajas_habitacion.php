<?php
 $id = $_POST['id'];
     require_once("../../../modelo/DAO/habitacionDAO.php"); 
    $tDAO = new HabitacionDAO();
         //Se agrega usuario y cliente
         $eliminar=$tDAO->eliminarHabitacion($id);    
         if($eliminar===1){
             echo "Eliminado";
         }else if($agregar===0){
             echo "Error";
         }  
?>