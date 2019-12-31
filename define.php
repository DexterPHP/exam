<?php

$Confing_folder = 'Config_folder/';
// Define   File
//define('Confing_folder/','Config_folder',false);

// MySql Denine
define('Host','localhost',false);
define('DB_Name','dac',false);
define('DB_UserName','root',false);
define('DB_Password','',false);

// API
define('API_SRC','./api/',false);

// Date
define('ThisYear',date('Y'),false );
define('NextYear',date('Y',strtotime('+1 year')),false);

// Script
define("ProjectTitle",'Document Management', false);
define("ProjectVersion",'1.0.0' , false);

// Programer Data
define("Programer",'Mohamad Khalaf' , false);
define("facebookA",'https://fb.com/fenix.p2h' , false);
?>