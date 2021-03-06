<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="google-signin-client_id" content="362692540628-9frn6nckr9jrahfko4ngab9j0nds5djb.apps.googleusercontent.com">

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        
        <link href="../controlador/php/registro/google.php">

         <!-- Titulo -->
         <title>RYOKŌ TRAVELS</title>

         <!-- Icono -->
         <link rel="icon" href="../imagenes/logo.png">
    </head>
    <body>
        <!-- Navbar-->
<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container">
            <!-- Navbar Brand -->
            <a href="#" class="navbar-brand">
                <img src="../imagenes/logo_2.png" alt="logo" width="150">
            </a>
        </div>
    </nav>
</header>


<div class="container">
    <div class="row py-5 mt-4 align-items-center">
        <!-- For Demo Purpose -->
        <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
            <img src="../imagenes/registro/registro.svg" alt="" class="img-fluid mb-3 d-none d-md-block">
           
            
        </div>

        <!-- Registeration Form -->
        <div class="col-md-7 col-lg-6 ml-auto">
            <h1>Crea una cuenta</h1>
            <form method="POST" action="../controlador/registro/procesar_altas_usuarios.php" id="registrar">
                <div class="row">

                <i class="input-group col-lg-6 mb-2 ">Correo</i>
                <i class="input-group col-lg-6 mb-2 ">Contraseña</i>

                     <!-- Email Address -->
                     <div class="input-group col-lg-6 mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-3 border-md border-right-0">
                                <i class="fa fa-envelope text-muted"></i>
                            </span>
                        </div>
                        <input id="email" type="email" name="email" placeholder="" class="form-control bg-white border-left-0 border-md" value="<?php  session_start(); if(isset($_SESSION['correo'])==1){echo $_SESSION['correo'];} ?>" required>
                    </div>

                     <!-- Password -->
                    <div class="input-group col-lg-6 mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-3 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="password" type="password" name="password" placeholder="" class="form-control bg-white border-left-0 border-md" required>
                    </div>

                    <!-- First Name -->
                   
                                <i class="input-group col-lg-6 mb-2 ">Nombre</i>
                                <i class="input-group col-lg-6 mb-2 ">Primer Apellido</i>
                          
                    <div class="input-group col-lg-6 mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-3 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="firstName" type="text" name="firstName" placeholder="" class="form-control bg-white border-left-0 border-md" value="<?php  if(isset($_SESSION['nombre'])==1){echo $_SESSION['nombre'];} ?>" required>
                    </div>

                    <!-- Last Name -->
                    <div class="input-group col-lg-6 mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-3 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="lastname" type="text" name="lastname" placeholder="" class="form-control bg-white border-left-0 border-md" value="<?php  if(isset($_SESSION['primerAp'])==1){echo $_SESSION['primerAp'];} ?>" required>
                    </div>

                    <i class="input-group col-lg-6 mb-2 ">Segundo Apellido</i>
                    <i class="input-group col-lg-6 mb-2 ">Telefono</i>

                    <!-- Last Name -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-3 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="lastName2" type="text" name="lastName2" placeholder="" class="form-control bg-white border-left-0 border-md" value="<?php if(isset($_SESSION['segundoAp'])==1){echo $_SESSION['segundoAp'];} ?>" required>
                    </div>


                    <!-- Phone Number -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-2 border-md border-right-0">
                                <i class="fa fa-phone-square text-muted"></i>
                            </span>
                        </div>
                        <input id="phoneNumber" type="tel" name="phoneNumber" placeholder="" class="form-control bg-white border-md border-left-0 pl-3" value="<?php if(isset($_SESSION['telefono'])==1){echo $_SESSION['telefono'];} ?>" required>
                    </div>

                    <!--Fecha de nacimiento-->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-black-tie text-muted">Fecha de nacimiento</i>
                            </span>
                        </div>
                        <input type="date" id="birthday" name="birthday" placeholder="Fecha de nacimiento" class="form-control bg-white border-md border-left-0 pl-3" value="<?php if(isset($_SESSION['fecha_nac'])==1){echo $_SESSION['fecha_nac'];} ?>" required>
                    </div>

                 
                   
                    
                    <div class="g-recaptcha" data-sitekey="6Lcb__8ZAAAAAGVgVpbTVN6T2ZPoEM3HZHMFTjo-" req style="padding-left: 22%; padding-bottom: 5%;"></div>

                    <!-- Submit Button -->
                    <div class="form-group col-lg-12 mx-auto mb-0" >
                        <button type="submit" class="btn btn-primary btn-block py-2" onclick="registrar()">
                            <span class="font-weight-bold">Crear cuenta      
                            </span>             
                    </button>
                    </div>

                   

                    <!-- Divider Text -->
                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
                        <div class="border-bottom w-100 ml-5"></div>
                        <span class="px-2 small text-muted font-weight-bold text-muted">O</span>
                        <div class="border-bottom w-100 mr-5"></div>
                    </div>

                    

                    <!--Registro con google-->
                   <div id="my-signin2" class="col-lg-8 mx-2" style="padding-left: 25%; padding-bottom: 1%;" data-onsuccess="onSignIn"></div>
            
                    <!-- Already Registered -->
                    <div class="text-center w-100">
                        <p class="text-muted font-weight-bold">¿Ya tienes una cuenta? <a href="../index.html" class="text-primary ml-2">Inicia sesión</a></p>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
<script src="../js/registro.js"></script>

    </body>
</html>

<?php
    unset($_SESSION['correo']);
    unset($_SESSION['nombre']);
    unset($_SESSION['primerAp']);
    unset($_SESSION['segundoAp']);
    unset($_SESSION['fecha_nac']);
    unset($_SESSION['telefono']);  
?>