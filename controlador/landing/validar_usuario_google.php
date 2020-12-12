<?php
require_once("../../modelo/DAO/usuarioDAO.php");  

//Validacion
$correo = $_POST['correo'];
$uDAO = new UsuarioDAO();

                    
 $res=$uDAO->validarUsuarioGoogle($correo);
 if($res>1){
    session_start();
    $_SESSION['autenticado'] = true;
    $_SESSION['usuario'] = $correo;
    echo 1;
}else{
    echo 0;
    
}


?>