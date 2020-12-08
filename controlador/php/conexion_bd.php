<?php
   class ConexionBD{
       private $conexion;

       private $host='localhost:3306';
       private $usuario='gvt';
       private $contraseña='123';
       private $bd='bd_agencia';

       public function __construct(){
           $this->conexion = mysqli_connect($this->host, $this->usuario, $this->contraseña, $this->bd);
        
           if($this->conexion)
               //echo "Conexion establecida :) <br> <br>";
               echo "<br>";
            else
                die("Error en conexion: ".mysqli_connect_error().mysqli_connect_errno());
           }  

        public function getConexion(){ return $this->conexion;}

   }

?>