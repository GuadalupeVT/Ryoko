<?php
require_once("../../../modelo/DAO/hotelDAO.php"); 
$hDAO = new HotelDAO();                  
$res=$hDAO->consultarHoteles();

echo($res);
?>