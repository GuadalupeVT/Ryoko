<?php
 $id = $_POST['id'];
 $inicio = $_POST['inicio'];
 $fin = $_POST['fin'];

 
//Verificacion de datos
if(empty($id) || empty($inicio) || empty($fin)){
    echo "No puede dejar campos vacios";
    
   }else{

     require_once("../../../modelo/DAO/reservaDAO.php"); 

    $tDAO = new ReservaDAO();
         //Se agrega usuario y cliente
         $agregar=$tDAO->modificarReserva($id,$inicio,$fin);
        
         if($agregar===1){
             echo "Se modifico registro";
         }else if($agregar===0){
             echo "Error";
         }  
}

?>