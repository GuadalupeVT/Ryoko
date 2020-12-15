<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cadena_JSON = file_get_contents('php://input'); //Recibe información a través de HTTP

        if($cadena_JSON == false) {
            echo "No hay cadena JSON";
        } else {
        	  
            $datos = json_decode($cadena_JSON, true);
            $id = $datos['id'];
            $inicio = $datos['inicio'];
            $fin = $datos['fin'];

         require_once("dao/reservaDAO.php"); 

         $tDAO = new ReservaDAO();
         //Se agrega usuario y cliente
         $agregar=$tDAO->modificarReserva($id,$inicio,$fin);
        
         if($agregar===1){
                    $respuesta['exito'] = true;
                    $respuesta['mensaje'] = "Se modifico reserva";
                    $cad = json_encode($respuesta);
                    echo ($cad);
         }else if($agregar===0){
                    $respuesta['exito'] = false;
                    $respuesta['mensaje'] = "No se pudo modificar";
                    $cad = json_encode($respuesta);
                    echo ($cad);
         }  

        } 
    
 }else {
    echo "No hay peticion HTTP";
}

?>