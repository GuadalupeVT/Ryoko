<?php

    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cadena_JSON = file_get_contents('php://input'); //Recibe información a través de HTTP
            require_once("dao/hotelDAO.php"); 
		         $tDAO = new HotelDAO();
		         //Se agrega usuario y cliente
		            $respuesta=$tDAO->obtenerId();  
                    echo ($respuesta);

  } else {
        echo "No hay peticion HTTP";
    }

?>