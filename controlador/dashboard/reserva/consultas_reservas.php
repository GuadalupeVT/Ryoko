<?php
require_once("../../../modelo/DAO/reservasDAO.php"); 
$hDAO = new ReservasDAO();                  
$res=$hDAO->consultarReservas();
echo($res);
?>