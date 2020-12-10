<?php
    include('../conexion_bd.php');

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
                $hotel = $_POST['hotel'];
                $transporte = $_POST['transporte'];
        
        //Verificacion de datos
                if(false){
                    echo "<p style='color:red;'>campos vacios</p>";
                }else{
        
                $correo_cifrado = sha1($correo);
                $contraseña_cifrada = sha1($contraseña);
        
        
                //$sql = "SELECT * FROM usuarios WHERE usuario='$correo_cifrado'";
        
                //$res = mysqli_query($conexion, $sql);
        
               // if(mysqli_num_rows($res)==1){
                   // echo "<p style='color:green;'>Ya existe usuario</p>";
               // }else{
                    //Verificar cuales casillas se marcaron
                    $tipo="";
                    if(!empty($cliente)){
                        $tipo ="1";
                    }
                    if(!empty($hotel)){
                        $tipo =$tipo."2";
                    }
                    if(!empty($transporte)){
                        $tipo =$tipo."3";
                        
                    }
                    /*
                    $sql2="INSERT INTO usuarios VALUES(sha1('$correo'), sha1('$contraseña'), '$tipo')";
                    $sql3="INSERT INTO cliente VALUES(sha1('$correo'), '$nombre', '$primerAp', '$segundoAp', '$fecha_nac', '$telefono')";
                    if(mysqli_query($conexion, $sql2)  ){
                        if(mysqli_query($conexion, $sql3) ){
                        header('location:../../../index.html');
                        }else{
                            echo $sql2;
                            echo $sql3;
                            echo "No se pudo insertar cliente";
                        }
                    }else{
                        echo $sql2;
                        echo $sql3;
                        echo "No se pudo insertar";
                    }
                    */
                    require_once("../../modelo/DAO/usuarioDAO.php");  
                    
                    $uDAO = new UsuarioDAO();

                    
                    $uDAO->agregarUsuario($correo,$contraseña,$tipo);
                   
                }
        
           // }
        
        
        
        } else { 
        
        echo "Captcha"; 
        
        }
    
   
?>