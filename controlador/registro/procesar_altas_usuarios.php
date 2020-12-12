<?php 

    $secret = "6Lcb__8ZAAAAAKXM4J42B_lsWnT3nIR4J5MuEGQh";

    if (isset($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response']; 
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
        'secret' => $secret,
        'response' => $captcha,
        'remoteip' => $_SERVER['REMOTE_ADDR']
        );
        
        $curlConfig = array(
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $data
        );
        
        $ch = curl_init();
        curl_setopt_array($ch, $curlConfig);
        $response = curl_exec($ch);
        curl_close($ch);
        }
        
        $jsonResponse = json_decode($response);
        
        if ($jsonResponse->success === true) {
        
            
                $correo = $_POST['email'];
                $contraseña = $_POST['password'];
                $nombre = $_POST['firstName'];
                $primerAp = $_POST['lastname'];
                $segundoAp = $_POST['lastName2'];
                $fecha_nac = $_POST['birthday'];
                $telefono = $_POST['phoneNumber'];
                
                $cliente = $_POST['cliente'];
        
        //Verificacion de datos
                if(empty($correo) || empty($nombre) || empty($primerAp) || empty($segundoAp) || empty($fecha_nac) || empty($telefono)){
                    session_start();
                            $_SESSION['correo'] = $correo;
                            $_SESSION['nombre'] = $nombre;
                            $_SESSION['primerAp']=$primerAp;
                            $_SESSION['segundoAp']=$segundoAp;
                            $_SESSION['fecha_nac']=$fecha_nac;
                            $_SESSION['telefono']=$telefono;
                            
                       echo "<script>
                                alert('No se pueden dejar campos vacios');
                                window.location.href='../../vista/registro.php';
                                console.log('$correo');
                             </script>";
                    
                }else{
                    require_once("../../modelo/DAO/usuarioDAO.php"); 
                    $uDAO = new UsuarioDAO();
                    $res=$uDAO->validarUsuarioGoogle($correo);
                    if($res>1){
                        session_start();
                            $_SESSION['correo'] = $correo;
                            $_SESSION['nombre'] = $nombre;
                            $_SESSION['primerAp']=$primerAp;
                            $_SESSION['segundoAp']=$segundoAp;
                            $_SESSION['fecha_nac']=$fecha_nac;
                            $_SESSION['telefono']=$telefono;
                            
                       echo "<script>
                                alert('Ese usuario ya existe');
                                window.location.href='../../vista/registro.php';
                                console.log('$correo');
                             </script>";
                   }else{
                        //Verificar cuales casillas se marcaron
                        $tipo="";
                        if(!empty($cliente)){
                            $tipo ="1";
                        }
                        if(!empty($_POST['hotel'])){
                            $tipo =$tipo."2";
                        }
                        if(!empty($_POST['transporte'])){
                            $tipo =$tipo."3";     
                        }

                        //Se agrega usuario y cliente
                        $agregarUsuario=$uDAO->agregarUsuario($correo,$contraseña,$tipo);
                        include_once("../../modelo/DAO/clienteDAO.php");  
                        $cDAO=new ClienteDAO();
                        $agregarCliente=$cDAO->agregarCliente($correo,$nombre,$primerAp,$segundoAp,$fecha_nac,$telefono);
                        
                        if($agregarUsuario===1 && $agregarCliente===1){
                            echo "<script>
                                alert('usuario registrado');
                                window.location.href='../../index.html';
                             </script>";
                        }else if($agregarUsuario===0 && $agregarCliente===0){
                            echo "<script>
                                alert('Ocurrio un error, intentalo mas tarde');
                                window.location.href='../../vista/registro.html';
                             </script>";
                        }
                   }

                   
                }
        
           // }
        
        
        
        } else { 
        
        echo "Captcha"; 
        
        }
    
   
?>