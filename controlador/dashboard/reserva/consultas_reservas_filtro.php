<?php
require_once("../../../modelo/DAO/reservaDAO.php");
$filtro = $_POST['filtro']; 
$hDAO = new ReservaDAO();                  
$res=$hDAO->consultarReservasFiltro($filtro);
echo($res);
?>