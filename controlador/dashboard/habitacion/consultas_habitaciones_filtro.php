<?php
require_once("../../../modelo/DAO/habitacionDAO.php");
$filtro = $_POST['filtro']; 
$hDAO = new HabitacionDAO();                  
$res=$hDAO->consultarHabitacionesFiltro($filtro);
echo($res);
?>