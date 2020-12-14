<?php
require_once("../../../modelo/DAO/reservaDAO.php"); 
$hDAO = new ReservaDAO();                  
$res=$hDAO->consultarReservas();
echo($res);
?>