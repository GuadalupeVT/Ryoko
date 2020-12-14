<?php
 $id = $_POST['id'];
     require_once("../../../modelo/DAO/reservaDAO.php"); 
    $tDAO = new ReservaDAO();
         //Se agrega usuario y cliente
         $eliminar=$tDAO->eliminarReserva($id);    
         if($eliminar===1){
             echo "Eliminado";
         }else if($agregar===0){
             echo "Error";
         }  
?>