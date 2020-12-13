<?php
require_once("../../../modelo/DAO/transporteDAO.php"); 
$hDAO = new TransporteDAO();                  
$res=$hDAO->consultarTransportes();
echo($res);
?>