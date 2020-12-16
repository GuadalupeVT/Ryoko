<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cadena_JSON = file_get_contents('php://input'); //Recibe información a través de HTTP

        if($cadena_JSON == false) {
            echo "No hay cadena JSON";
        } else {

            $datos = json_decode($cadena_JSON, true);
            $id = $datos['id'];

		         require_once("dao/reservaDAO.php"); 
		         $tDAO = new ReservaDAO();
		         //Se agrega usuario y cliente
		             
		            //$tDAO->eliminarReserva($id);
		            if($tDAO->eliminarReserva($id)===1){
		            $respuesta['exito'] = true;
                    $respuesta['mensaje'] = "Se elimino";
                    $cad = json_encode($respuesta);
                    echo ($cad);
		         }else{
		            $respuesta['exito'] = false;
                    $respuesta['mensaje'] = "No se pudo eliminar";
                    $cad = json_encode($respuesta);
                    echo ($cad);
		         }  

        } 
    
 }else {
    echo "No hay peticion HTTP";
}

?>