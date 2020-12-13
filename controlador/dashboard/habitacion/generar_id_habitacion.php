<?php
 
     require_once("../../../modelo/DAO/habitacionDAO.php"); 

    $tDAO = new HabitacionDAO();
    echo $agregar=$tDAO->generarId();
?>