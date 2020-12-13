<?php
 
     require_once("../../../modelo/DAO/transporteDAO.php"); 

    $tDAO = new TransporteDAO();
    echo $agregar=$tDAO->generarId();
?>