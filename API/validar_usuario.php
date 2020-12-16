<?php

    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cadena_JSON = file_get_contents('php://input'); //Recibe información a través de HTTP
        
        if($cadena_JSON == false) {
          echo "No hay cadena JSON";
        } else {
            require_once("conexion/conexion.php"); 
            $cc = ConexionBD::getConexion();
            
            $filtro = json_decode($cadena_JSON, true);
            $usuario = $filtro['usuario'];
            $contraseña = $filtro['contraseña'];

       
            $busqueda=$cc->db->query("Select * from usuarios WHERE usuario=sha1('". $usuario."') AND contraseña=sha1('". $contraseña."')");
            
            $data=array();
            while($r=$busqueda->fetch(PDO::FETCH_ASSOC)){
                $data[]=$r;
            }
            /*Almacenamos el resultado de fetchAll en una variable*/
            echo json_encode(array("usuarios"=>$data));
            
        }
      
    } else {
        echo "No hay peticion HTTP";
    }

?>