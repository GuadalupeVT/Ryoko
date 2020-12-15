<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cadena_JSON = file_get_contents('php://input'); //Recibe información a través de HTTP

        if($cadena_JSON == false) {
            echo "No hay cadena JSON";
        } else {
            
            $datos = json_decode($cadena_JSON, true);
            $fecha_inicio = $datos['inicio'];
            $fecha_fin = $datos['fin'];
            $destino=$datos['destino'];
            $tipo=$datos['tipo'];


			require_once("dao/reservaDAO.php"); 
			$hDAO = new ReservaDAO();   
			$id_reserva=$hDAO->generarId();
			$id_usuario=$hDAO->obtenerUsuario();
			$obtener_id_hotel=$hDAO->obtenerHotel($destino);
			$obtener_id_habitacion=$hDAO->obtenerHabitacion($obtener_id_hotel);
			$obtener_id_transporte=$hDAO->obtenerTransporte($tipo);
			$total=$hDAO->obtenerTotal($obtener_id_habitacion,$obtener_id_transporte);

			if($obtener_id_habitacion==""|| $obtener_id_transporte==""){
			        $respuesta['exito'] = false;
                    $respuesta['mensaje'] = "No se encontro reserva con esos parametros";
                    $cad = json_encode($respuesta);
                    echo ($cad);

			}else{

			if($hDAO->agregarReserva($id_reserva, $fecha_inicio, $fecha_fin, $obtener_id_habitacion, $id_usuario, $obtener_id_transporte, $total)){
				    $respuesta['exito'] = true;
                    $respuesta['mensaje'] = "Se registro Reserva";
                    $cad = json_encode($respuesta);
                    echo ($cad);
			}else{
				    $respuesta['exito'] = false;
                    $respuesta['mensaje'] = "No se pudo procesar reserva";
                    $cad = json_encode($respuesta);
                    echo ($cad);
			}

			}

			echo $res;




			           }

			} else {
			    echo "No hay peticion HTTP";
			}

?>