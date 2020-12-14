<?php
//session_start();

$fecha_inicio=$_POST['inicio'];
$fecha_fin=$_POST['fin'];

$destino = $_POST['destino'];
$tipo=$_POST['tipo'];

require_once("../../../modelo/DAO/reservaDAO.php"); 
$hDAO = new ReservaDAO();   
$id_reserva=$hDAO->generarId();
$id_usuario=$hDAO->obtenerUsuario();
$obtener_id_hotel=$hDAO->obtenerHotel($destino);
$obtener_id_habitacion=$hDAO->obtenerHabitacion($obtener_id_hotel);
$obtener_id_transporte=$hDAO->obtenerTransporte($tipo);
$total=$hDAO->obtenerTotal($obtener_id_habitacion,$obtener_id_transporte);

if($obtener_id_habitacion==""|| $obtener_id_transporte==""){
    $res= 0;
}else{

$res=1;
$hDAO->agregarReserva($id_reserva, $fecha_inicio, $fecha_fin, $obtener_id_habitacion, $id_usuario, $obtener_id_transporte, $total);

}

echo $res;
?>