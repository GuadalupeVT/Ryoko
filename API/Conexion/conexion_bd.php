<?php
class ConexionBD { 

    public $db;     
    private static $dns = "mysql:host=localhost;dbname=bd_agencia"; 
    private static $user = "gvt"; 
    private static $pass = "123";     
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