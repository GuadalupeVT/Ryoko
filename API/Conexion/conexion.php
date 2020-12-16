<?php
class ConexionBD { 

    public $db;     
    private static $dns = "mysql:host=localhost;dbname=id15673807_bd_agencia"; 
    private static $user = "id15673807_cliente"; 
    private static $pass = "9/4_XvKNh%Wnd/EL";     
    private static $instance;

    public function __construct ()  
    {        
       $this->db = new PDO(self::$dns,self::$user,self::$pass);       
    } 

    public static function getConexion()
    { 
        if(!isset(self::$instance)) 
        { 
            $object= __CLASS__; 
            self::$instance=new $object; 
        } 
        return self::$instance; 
    }    
} 
?>