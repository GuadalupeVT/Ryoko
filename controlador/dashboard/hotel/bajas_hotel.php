<?php
 $id = $_POST['id'];
     require_once("../../../modelo/DAO/hotelDAO.php"); 
    $tDAO = new HotelDAO();
         //Se agrega usuario y cliente
         $eliminar=$tDAO->eliminarHotel($id);    
         if($eliminar===1){
             echo "Eliminado";
         }else if($agregar===0){
             echo "Error";
         }  
?>