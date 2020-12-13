<?php
require_once("../../modelo/DAO/usuarioDAO.php");  

//Validacion
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$uDAO = new UsuarioDAO();

                    
 if(empty($res=$uDAO->validarUsuario($correo,$contraseña))){
      echo "<script> alert('Ese usuario no existe'); </sctipt>";
      header("location:../../index.html");
 }else{
     echo "Si hay";
     session_start();
     $_SESSION['autenticado'] = true;
     $_SESSION['usuario'] = $correo;
     $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
     header("location:../../vista/dashboard/dashboard.php");
 }

    



?>