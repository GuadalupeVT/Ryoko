<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cadena_JSON = file_get_contents('php://input'); //Recibe información a través de HTTP

        if($cadena_JSON == false) {
            echo "No hay cadena JSON";
        } else {
            
            $datos = json_decode($cadena_JSON, true);
             $correo = $datos['email'];
             $contraseña = $datos['contraseña'];
             
             
              require_once("dao/usuarioDAO.php"); 
              $uDAO = new UsuarioDAO();
              $res=$uDAO->validarUsuario($correo,$contraseña);
              $respuesta = array();
              
              if(count($res)===1){
                    $respuesta['exito'] = true;
                    $respuesta['mensaje'] = "Bienvenido";
                    $cad = json_encode($respuesta);
                    echo ($cad);
              }else{
                    $respuesta['exito'] = false;
                    $respuesta['mensaje'] = "Datos Incorrectos!";
                    $cad = json_encode($respuesta);
                    echo ($cad);
            
                }
            
            
        }
             
    
} else {
     echo "No hay peticion HTTP";
}

?>