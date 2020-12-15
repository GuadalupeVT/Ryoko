<?php

    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cadena_JSON = file_get_contents('php://input'); //Recibe información a través de HTTP
        
        if($cadena_JSON == false) {
          echo "No hay cadena JSON";
        } else {
            require_once("conexion/conexion.php"); 
            $cc = ConexionBD::getConexion();
            
            $filtro = json_decode($cadena_JSON, true);
            $id_cliente = $filtro['id_cliente'];
            $parametro= $filtro['parametro'];

        if( $id_cliente==='admin'){
               $busqueda=$cc->db->query("Select * from reporte_reserva where tipo LIKE '%".$parametro."%' OR disponibilidad LIKE '%".$parametro."%'");
            }else{
                $busqueda=$cc->db->query("Select * from reporte_reserva WHERE tipo LIKE '%".$parametro."%' OR disponibilidad LIKE '%".$parametro."%' AND id_Cliente=sha1('". $id_cliente."')");
            }
            $data=array();
            while($r=$busqueda->fetch(PDO::FETCH_ASSOC)){
                $data[]=$r;
            }
            /*Almacenamos el resultado de fetchAll en una variable*/
            echo json_encode(array("reservas"=>$data));
            
            
            
            
        }

       
      
    } else {
        echo "No hay peticion HTTP";
    }

?>