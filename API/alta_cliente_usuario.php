<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cadena_JSON = file_get_contents('php://input'); //Recibe información a través de HTTP

        if($cadena_JSON == false) {
            echo "No hay cadena JSON";
        } else {
        	 $datos = json_decode($cadena_JSON, true);
        	 $correo = $datos['email'];
             $contraseña = $datos['contraseña'];
             $nombre = $datos['nombre'];
             $primerAp = $datos['primerAp'];
             $segundoAp = $datos['segundoAp'];
             $fecha_nac = $datos['fecha_nac'];
             $telefono = $datos['telefono'];
             
              require_once("dao/usuarioDAO.php"); 
              $uDAO = new UsuarioDAO();
              $res=$uDAO->validarUsuarioGoogle($correo);
              $respuesta = array();
              if($res>1){
		               	$respuesta['exito'] = false;
		                $respuesta['mensaje'] = "Ese usuario ya existe";
		                $cad = json_encode($respuesta);
		                echo ($cad);
                   }else{
                        //Se agrega usuario y cliente

                   	    $agregarUsuario=$uDAO->agregarUsuario($correo,$contraseña);
                        include_once("dao/clienteDAO.php");  
                        $cDAO=new ClienteDAO();
                        $agregarCliente=$cDAO->agregarCliente($correo,$nombre,$primerAp,$segundoAp,$fecha_nac,$telefono);

                        //Verificar respuesta
                         if($agregarUsuario===1 && $agregarCliente===1){
	                            $respuesta['exito'] = true;
				                $respuesta['mensaje'] = "Usuario registrado correctamente";
				                $cad = json_encode($respuesta);
				                echo ($cad);
                        }else if($agregarUsuario===0 && $agregarCliente===0){
                                $respuesta['exito'] = false;
				                $respuesta['mensaje'] = "Ocurrio un error, intentalo mas tarde";
				                $cad = json_encode($respuesta);
				                echo ($cad);
                        }
        }
              
            
        }
} else {
     echo "No hay peticion HTTP";
}

?>