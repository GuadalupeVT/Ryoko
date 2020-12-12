<?php
 $id = $_POST['id'];
     require_once("../../../modelo/DAO/transporteDAO.php"); 
    $tDAO = new TransporteDAO();
         //Se agrega usuario y cliente
         $eliminar=$tDAO->eliminarTransporte($id);    
         if($eliminar===1){
             echo "Eliminado";
         }else if($agregar===0){
             echo "Error";
         }  
?>