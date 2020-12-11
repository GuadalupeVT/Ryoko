<?php
require_once("../../modelo/DAO/usuarioDAO.php");  

//Validacion
$correo = $_POST['correo'];
$uDAO = new UsuarioDAO();

                    
 $res=$uDAO->validarUsuarioGoogle($correo);
 if($res>1){
    echo 1;
}else{
    echo 0;
    
}


?>