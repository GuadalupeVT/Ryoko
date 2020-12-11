<?php
require_once("../../modelo/DAO/usuarioDAO.php");  

//Validacion
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$uDAO = new UsuarioDAO();

                    
$res=$uDAO->validarUsuario($correo,$contraseña);

if($res>1){
    echo "Si existe";
}else{
    echo "Error";
    
}


?>