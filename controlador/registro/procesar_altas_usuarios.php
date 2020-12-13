<?php 


        $correo = trim($_POST['email']);
        $contraseña = trim($_POST['password']);
        $nombre = trim($_POST['firstName']);
        $primerAp = trim($_POST['lastname']);
        $segundoAp = trim($_POST['lastName2']);
        $fecha_nac = trim($_POST['birthday']);
        $telefono = trim($_POST['phoneNumber']);

        session_start();
        $_SESSION['correo'] = $correo;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['primerAp']=$primerAp;
        $_SESSION['segundoAp']=$segundoAp;
        $_SESSION['fecha_nac']=$fecha_nac;
        $_SESSION['telefono']=$telefono;


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
        
        
        //Verificacion de datos
                if(empty($correo) || empty($nombre) || empty($primerAp) || empty($segundoAp) || empty($fecha_nac) || empty($telefono)){
                            
                       echo "<script>
                                alert('No se pueden dejar campos vacios');
                                window.location.href='../../vista/registro.php';
                             </script>";
                    
                }else{
                //Varificar telefono
                if(strlen($telefono)!=10 || is_numeric($telefono)==false){
                    echo "<script>
                    alert('Telefono incorrecto!');
                    window.location.href='../../vista/registro.php';
                 </script>";

                }else{
                    //verificar correo
                    if(strpos($correo,"@")==false || strpos($correo,".")==false){
                        echo "<script>
                        alert('Correo incorrecto!');
                        window.location.href='../../vista/registro.php';
                     </script>";

                    }else{


                    require_once("../../modelo/DAO/usuarioDAO.php"); 
                    $uDAO = new UsuarioDAO();
                    $res=$uDAO->validarUsuarioGoogle($correo);
                    if($res>1){
                        
                            
                       echo "<script>
                                alert('Ese usuario ya existe');
                                window.location.href='../../vista/registro.php';
                             </script>";
                   }else{
                        //Verificar cuales casillas se marcaron

                        //Se agrega usuario y cliente
                        $agregarUsuario=$uDAO->agregarUsuario($correo,$contraseña);
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
        
            }}
        
        } else { 
        
        echo "Captcha"; 
        
        }
    
   
?>