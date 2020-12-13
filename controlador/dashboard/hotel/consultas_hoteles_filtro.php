<?php
require_once("../../../modelo/DAO/hotelDAO.php");
$filtro = $_POST['filtro']; 
$hDAO = new HotelDAO();                  
$res=$hDAO->consultarHotelesFiltro($filtro);
echo($res);
?>