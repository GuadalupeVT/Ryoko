<?php

    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cadena_JSON = file_get_contents('php://input'); //Recibe información a través de HTTP
            require_once('conexion/conexion.php');
            $cc = ConexionBD::getConexion();
           
            $busqueda=$cc->db->query("SELECT id_Hotel FROM hotel");
            
            $data=array();
            while($r=$busqueda->fetch(PDO::FETCH_ASSOC)){
                $data[]=$r;
            }
            /*Almacenamos el resultado de fetchAll en una variable*/
            echo json_encode(array("id"=>$data));
              

  } else {
        echo "No hay peticion HTTP";
    }

?>