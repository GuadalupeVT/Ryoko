<?php
    session_start();
    if($_SESSION['autenticado'] == false){
        header("location:../../index.html");
        echo $_SESSION['autenticado'];
    } else {
        // calculamos el tiempo transcurrido
        $fechaGuardada = $_SESSION["ultimoAcceso"];
        $ahora = date("Y-n-j H:i:s");
        $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
    
        //comparamos el tiempo transcurrido
         if($tiempo_transcurrido >= 600) {
         //si pasaron 10 minutos o más
          session_destroy(); // destruyo la sesión
          header("location:../../index.html");//envío al usuario a la pag. de autenticación
          //sino, actualizo la fecha de la sesión
        }else {
        $_SESSION["ultimoAcceso"] = $ahora;
       }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Titulo -->
    <title>RYOKŌ TRAVELS</title>

    <!-- Icono -->
    <link rel="icon" href="../../imagenes/logo.png">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                   
                </div>
                <div class="sidebar-brand-text mx-3">RYOKŌ TRAVELS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                   <i class="icon ion-md-apps"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Cliente
            </div>

            <li class="nav-item">
                <a class="nav-link" href="dashboard_reservas.php">
                   <i class="icon ion-md-calendar mr-2 lead p-2"></i>
                    <span>Mis reservas</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Proveedor Hoteles
            </div>


            <!-- Nav Item - Charts -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard_hotel.php">
                   <i class="icon ion-md-business mr-2 lead p-2"></i>
                    <span>Mis hoteles</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard_habitaciones.php">
                   <i class="icon ion-md-business mr-2 lead p-2"></i>
                    <span>Mis habitaciones</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Proveedor transportes
            </div>


            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard_transporte.php">
                   <i class="icon ion-md-business mr-2 lead p-2"></i>
                    <span>Mis transportes</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar..."
                                aria-label="Search" aria-describedby="basic-addon2" id="buscar" name="buscar">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['usuario'];  ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                               
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Hoteles</h1>
                        <a href="#addTransporte" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalRegisterForm" onclick="limpiar();">
                        <i class="icon ion-md-add"></i> Agregar</a>
                    </div>

 

<ul id="example-1">
               
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Calle</th>
                                <th scope="col">Número</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Acción</th>
                            </tr>
                            <tr v-for="item in items">
                                <td v-text="item.id_Hotel"> </td>
                                <td v-text="item.nombre"></td>
                                <td v-text="item.categoria"></td>
                                <td v-text="item.telefono"></td>
                                <td v-text="item.direccion_calle"></td>
                                <td v-text="item.direccion_numero"></td>
                                <td v-text="item.direccion_ciudad"></td>
                                <td>
                                <a class="btn btn-warning ajax-request" id="modificar" data-toggle="modal" data-target="#modalRegisterForm" v-on:click="modificar(item.id_Hotel,item.nombre,item.categoria,item.telefono,item.direccion_calle, item.direccion_numero,item.direccion_ciudad)">
              <i class="fas fa-edit"></i>
              </a>
              <?php
              ?>
              <a class="btn btn-danger ajax-request" id="eliminar" v-on:click="eliminar(item.id_Hotel)"> 
              <i class="fas fa-trash"></i>
                                </td>
                            </tr>

                    </table>
                    </ul>

                        <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header text-center">
                                <h4 id="titulo" class="modal-title w-100 font-weight-bold">Agregar Hotel</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body mx-3">
                                <div class="md-form mb-2">
                                <label data-error="wrong" data-success="right" for="orangeForm-email">Id</label>
                                <input id="id" type="text" name="id" placeholder="Id" class="form-control bg-white border-left-0 border-md" required>
                                </div>

                                <div class="md-form mb-2">
                                <label data-error="wrong" data-success="right" for="orangeForm-pass">Nombre</label>
                                <input id="nombre" type="text" name="nombre" placeholder="Nombre" class="form-control bg-white border-left-0 border-md" required>
                                </div>

                                <div class="md-form mb-2">
                                <label data-error="wrong" data-success="right" for="orangeForm-email">Categoria</label>
                                <select id="categoria" name="categoria" class="custom-select form-control bg-white border-left-0 border-md h-100 font-weight-bold text-muted">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="2">3</option>
                                    <option value="2">4</option>
                                    <option value="2">5</option>
                                </select>
                                </div>


                                <div class="md-form mb-2">
                                <label data-error="wrong" data-success="right" for="orangeForm-pass">Telefono</label>
                                <input id="phoneNumber" type="tel" name="phoneNumber" placeholder="Telefono" class="form-control bg-white border-md border-left-0 pl-3" required>
                                </div>

                                <div class="md-form mb-2">
                                <label data-error="wrong" data-success="right" for="orangeForm-pass">Calle</label>
                                <input id="calle" type="text" name="calle" placeholder="Calle" class="form-control bg-white border-md border-left-0 pl-3" required>
                                </div>

                                <div class="md-form mb-2">
                                <label data-error="wrong" data-success="right" for="orangeForm-pass">Numero</label>
                                <input id="numero" type="num" name="numero" placeholder="Numero" class="form-control bg-white border-md border-left-0 pl-3" required>
                                </div>

                                <div class="md-form mb-2">
                                <label data-error="wrong" data-success="right" for="orangeForm-pass">Ciudad</label>
                                <input id="ciudad" type="text" name="ciudad" placeholder="Ciudad" class="form-control bg-white border-md border-left-0 pl-3" required>
                                </div>

                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button class="btn btn-primary btn-block py-2" id="btn_agregar_modificar">Agregar</button>
                            </div>
                            </div>
                        </div>
                        </div>          

                            
                           
                           

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

   <!-- Logout Modal-->
   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../../controlador/cerrar_sesion.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script src="https://unpkg.com/vue"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="../../js/dashboard/hoteles.js"></script>

</body>

</html>