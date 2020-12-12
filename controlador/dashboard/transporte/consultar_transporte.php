<?php
 $id = $_POST['id'];
     require_once("../../../modelo/DAO/transporteDAO.php"); 
     $tDAO = new TransporteDAO();
                   
$res=$tDAO->consultarTransporte_id($id);
foreach ($res as $muestra) {
    $tipo= $muestra['tipo'];
}
return $tipo;
?>