<?php
require_once("../../../modelo/DAO/transporteDAO.php");
$filtro = $_POST['filtro']; 
$hDAO = new TransporteDAO();                  
$res=$hDAO->consultarTransportesFiltro($filtro);
echo($res);
?>