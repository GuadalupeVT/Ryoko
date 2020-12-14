<?php
//session_start();

$fecha_inicio=$_POST['inicio'];
$fecha_fin=$_POST['fin'];

$destino = $_POST['destino'];
$tipo=$_POST['tipo'];

require_once("../../../modelo/DAO/reservaDAO.php"); 
$hDAO = new ReservaDAO();   
$id_reserva=$hDAO->generarId();
$id_cliente=$hDAO->obtenerUsuario();
$id_hotel=$hDAO->obtenerHotel($destino);
$id_habitacion=$hDAO->obtenerHabitacion($id_hotel);
$id_transporte=$hDAO->obtenerTransporte($tipo);
$total=$hDAO->obtenerTotal($id_habitacion,$id_transporte);


echo $res=$hDAO->agregarReserva($id_reserva, $fecha_inicio, $fecha_fin, $id_habitacion, $id_cliente, $id_transporte, $total);

?>