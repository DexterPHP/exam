<?php
  if(file_exists($Confing_folder.'connaction_classic.php')){include_once $Confing_folder.'connaction_classic.php';} else{die("Connaction Classic File is Miss"); }
  $settings = $DexterC->query("select * from settings where id =1") or die();
  $settin =  $settings->fetch_object();
  $public_folder = $settin->upload_folder;
  $extensions =  $settin->doc_type;
  $max_size = $settin->doc_max_size;
  function AlllowType($extensions){
      $data = [];
       $extensions = explode(',',$extensions);
      foreach($extensions as $type){
          array_push($data,'.'.$type);
      }
      return $data;
  }
$files = $extensions;
$okkk =  AlllowType($files);





?>