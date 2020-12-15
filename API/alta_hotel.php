<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cadena_JSON = file_get_contents('php://input'); //Recibe información a través de HTTP

        if($cadena_JSON == false) {
            echo "No hay cadena JSON";
        } else {
            
            $datos = json_decode($cadena_JSON, true);
            $id_hotel = $datos['id'];
            $nombre = $datos['nombre'];
            $categoria=$datos['categoria'];
            $telefono=$datos['telefono'];
            $dir_calle=$datos['calle'];
            $dir_num=$datos['numero'];
            $dir_ciudad=$datos['ciudad'];



			require_once("dao/hotelDAO.php"); 
			$hDAO = new HotelDAO();   
			$respuesta=$hDAO-> agregarHotel($id_hotel, $nombre, $categoria, $telefono, $dir_calle,$dir_num, $dir_ciudad);

			if($respuesta===true){
			        $respuesta['exito'] = true;
                    $respuesta['mensaje'] = "Se registro reserva";
                    $cad = json_encode($respuesta);
                    echo ($cad);

			}else if(($respuesta===false)){
				    $respuesta['exito'] = false;
                    $respuesta['mensaje'] = "No se pudo registrar";
                    $cad = json_encode($respuesta);
                    echo ($cad);

			     }
        }

			} else {
			    echo "No hay peticion HTTP";
			}

?>