<?php
  //  Connect Here  +   Define Var
  if(file_exists('define.php')){include_once 'define.php';} else{die("Define File is Miss"); }
  // Function Class
  if(file_exists($Confing_folder.'function_file.php')){include_once $Confing_folder.'function_file.php';} else{die("Function File is Miss"); }
    // Header Set
  if(file_exists($Confing_folder.'header_local.php')){include_once $Confing_folder.'header_local.php';} else{die("header File is Miss"); }

 // NavBar
  if(file_exists($Confing_folder.'navbar.php')){include_once $Confing_folder.'navbar.php';} else{die("Navbar File is Miss"); }
   // Menu Set
  if(file_exists($Confing_folder.'left_menu.php')){include_once $Confing_folder.'left_menu.php';} else{die("left menu File is Miss" ); }

  ## { Page Content Here } ##
if(file_exists('add_deb.php')){include_once 'add_deb.php';} else{die("Add Department File is Miss" ); }
  ## { Page Content Here } ##

   // Footer Set
  if(file_exists($Confing_folder.'footer_local.php')){include_once $Confing_folder.'footer_local.php';} else{die("Footer File is Miss"); }
?>