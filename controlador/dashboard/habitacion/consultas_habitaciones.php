<?php
require_once("../../../modelo/DAO/habitacionDAO.php"); 
$hDAO = new HabitacionDAO();                  
$res=$hDAO->consultarHabitaciones();

echo($res);
?>