<?php
 
     require_once("../../../modelo/DAO/HotelDAO.php"); 

    $tDAO = new HotelDAO();
    echo $agregar=$tDAO->generarId();
?>