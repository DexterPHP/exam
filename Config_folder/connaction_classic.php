<?php
if(file_exists('define.php')){include_once 'define.php';} else{die("Define File is Miss"); }



// used to get mysql database connection
class Database{

    // specify your own database credentials
    private $host     = Host;
    private $db_name  = DB_Name;
    private $username = DB_UserName;
    private $password = DB_Password;
    public  $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;


            //$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $connaction = new mysqli($this->host,$this->username,$this->password,$this->db_name);
             $connaction->query("set names 'utf8'");

        return $connaction;
    }
}


// get database connection
$database = new Database();
$GLOBALS['database'] = $database;

if(file_exists('check.php')){include_once 'check.php';} else{die("check File is Miss"); }

if($database->getConnection() != null ){
   $DexterC = $database->getConnection();
}
else{
    die("No Connaction ");
    exit("No Connaction ");
}
?>