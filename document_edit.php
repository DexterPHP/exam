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
  ?>
  
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 text-left">
            <h1> Edit Document</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Documents</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <form method="post" enctype="multipart/form-data">
        <?php
        if(isset($_GET['doc']))
        {
            $doc_id = intval($_GET['doc']);
            $docx_sql = $DexterC->query('select * from  documents where id='.$doc_id.' limit 1') or die('??');
            $total = $docx_sql->num_rows;
            if($total > 0 )
            {
                $data_doc = $docx_sql->fetch_object();
                $rand = rand(0,999999);
                  if(isset($_POST['Token']) && $_POST['Token'] = $rand){
                      $doc_titl = filter_var($_POST['doc_title'],FILTER_SANITIZE_STRING);
                      $doc_desc = filter_var($_POST['doc_desc'] ,FILTER_SANITIZE_STRING);
                      $doc_comm = filter_var($_POST['doc_comm'] ,FILTER_SANITIZE_STRING);
                      $doc_tags = filter_var($_POST['doc_tags'] ,FILTER_SANITIZE_STRING);
                      $doc_depa = filter_var($_POST['depart']   ,FILTER_VALIDATE_INT);
                      $doc_cate = filter_var($_POST['cater']    ,FILTER_VALIDATE_INT);
                      $doc_arch = filter_var($_POST['archive']  ,FILTER_VALIDATE_INT);
                      $doc_type = filter_var($_POST['Type']     ,FILTER_SANITIZE_STRING);
                      $doc_ownr = filter_var($_POST['owner']    ,FILTER_VALIDATE_INT);
                      //$doc_files= filter_var($_POST['doc_title'],FILTER_SANITIZE_STRING);
                      $All_file = [];
                      // upload Files
        
            // Configure upload directory and allowed file types
            $upload_dir = $public_folder.DIRECTORY_SEPARATOR;
            $allowed_types = explode(',',$extensions);
        
            // Define maxsize for files i.e 2MB
            $maxsize = intval($max_size)* 1024 * 1024;
        
            // Checks if user sent an empty form
            if(!empty(array_filter($_FILES['Doc']['name']))) {
        
                // Loop through each file in files[] array
                foreach ($_FILES['Doc']['tmp_name'] as $key => $value) {
        
                    $file_tmpname = $_FILES['Doc']['tmp_name'][$key];
                    $file_name = $_FILES['Doc']['name'][$key];
                    $file_size = $_FILES['Doc']['size'][$key];
                    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        
                    // Set upload file path
                    $filepath = $upload_dir.$file_name;
        
                    // Check file type is allowed or not
                    if(in_array(strtolower($file_ext), $allowed_types)) {
        
                        // Verify file size - 2MB max
                        if ($file_size > $maxsize)
                            echo "Error: File size is larger than the allowed limit.";
        
                        // If file with name already exist then append time in
                        // front of name of the file to avoid overwriting of file
                        if(file_exists($filepath)) {
                            $filepath = $upload_dir.time().$file_name;
        
                            if( move_uploaded_file($file_tmpname, $filepath)) {
                                //echo "{$file_name} successfully uploaded <br />";
                                array_push($All_file,$filepath);
                            }
                            else {
                                echo "Error uploading {$file_name} <br />";
                            }
                        }
                        else {
        
                            if( move_uploaded_file($file_tmpname, $filepath)) {
                                echo "{$file_name} successfully uploaded <br />";
                            }
                            else {
                                echo "Error uploading {$file_name} <br />";
                            }
                        }
                    }
                    else {
        
                        // If file extention not valid
                        echo "Error uploading {$file_name} ";
                        echo "({$file_ext} file type is not allowed)<br / >";
                    }
                }
                 $All_file = json_encode($All_file,true);
        
                // Now Insert To DataBase
                
                $let_us_update = $DexterC->query('update documents set
                    title           = "'.$doc_titl.'",
                    owner           = "'.$doc_ownr.'",
                    commnt          = "'.$doc_comm.'",
                    cater_id        = "'.$doc_cate.'",
                    tags            = "'.$doc_tags.'",
                    depart          = "'.$doc_depa.'",
                    file_link       = "'.htmlspecialchars($All_file).'",
                    doc_type        = "'.$doc_type.'",
                    desc_text       = "'.$doc_desc.'",
                    archived        = "'.$doc_arch.'"
                    where id        =  '.$doc_id.'
                ') or die($DexterC->error.'Error in update document');
                

                if(isset($let_us_update)){
                    echo'
                    <div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h5><i class="icon fas fa-check"></i> Greate</h5>
                          Success Upload File/s And add To our system.
                        </div>
                    ';
        
                }
            }
            else {
                // If no files selected
                echo '
                   <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h5><i class="icon fas fa-ban"></i> Alert! </h5>
                         No files selected
                        </div>
                ';
            }
        
        
                  }
                ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title text-left">Document Info</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                          <i class="fas fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="card-body  text-left">
                      <div class="form-group">
                        <label for="inputName">  Title</label>
                        <input required="required" name="doc_title" type="text" id="inputName" class="form-control" min="3" value="<? echo $data_doc->title; ?>">
                      </div>
                      <div class="form-group">
                        <label for="inputDescription">Description</label>
                        <input required="required" name="doc_desc" type="text" id="inputName" class="form-control" min="3" value="<? echo $data_doc->desc_text ?>">
                      </div>
                       <div class="form-group">
                      <label for="inputName">Comment</label>
                        <input required="required" name="doc_comm" type="num" id="inputName" class="form-control" min="3" value="<? echo $data_doc->commnt ?>">
                      </div>
                      <div class="form-group">
                        <label for="inputClientCompany">Tags</label>
                        <input required="required" type="text" name="doc_tags" id="inputClientCompany" class="form-control" min="3" value="<? echo $data_doc->tags ?>">
                      </div>
        
                      <div class="form-group">
                        <label for="inputClientCompany">Upload Document</label>
                        <input required="required" type="file" multiple="" name="Doc[]" accept="file_extension|<?php foreach($okkk as $type_is){ echo $type_is.','; }?>
                        " multiple="multiple" id="inputClientCompany" class="form-control">
                      </div>
        
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <div class="col-md-6">
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title text-left">Document Info</h3>
        
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                          <i class="fas fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="card-body  text-left">
                     <div class="form-group">
                        <label for="inputStatus">Department</label>
                        <select class="form-control custom-selec" name="depart" required="required">
                            <option   disabled="disabled"> Please Select  </option>
                           <?php
                           $Depart = $DexterC->query("select * from department order by depart_title asc") or die();
                           while($dapart_data = $Depart->fetch_object()){
                               echo'<option value="'.$dapart_data->id.'" >'.htmlspecialchars($dapart_data->depart_title).'</option>';
        
                           }
                           ?>
                        </select>
                    </div>
        
                     <div class="form-group">
                        <label for="inputStatus">Category</label>
                        <select class="form-control custom-selec" name="cater" required="required">
                            <option  disabled="disabled"> Please Select  </option>
                           <?php
                           $Cater = $DexterC->query("select * from category order by center_name asc") or die();
                           while($ccater_data = $Cater->fetch_object()){
                               echo'<option value="'.$ccater_data->id.'" >'.htmlspecialchars($ccater_data->center_name).'</option>';
        
                           }
                           ?>
                        </select>
                    </div>
        
                       <div class="form-group">
                        <label for="inputStatus">Document type </label>
                        <select class="form-control custom-selec" name="Type" required="required">
                            <option   disabled="disabled"> Please Select  </option>
                            <option value="private" >Private</option>
                            <option value="public" >Public</option>
                        </select>
                    </div>
        
                     <div class="form-group">
                        <label for="inputStatus">Owner</label>
                        <select class="form-control custom-selec" name="owner" required="required">
                            <option   disabled="disabled"> Please Select  </option>
                           <?php
        
                           $oWner = $DexterC->query("select * from owners order by owner_name asc") or die();
                           while($owner_data = $oWner->fetch_object()){
                               echo'<option value="'.$owner_data->id.'" >'.htmlspecialchars($owner_data->owner_name).'</option>';
        
                           }
                           ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputStatus">Is Document َArchived</label>
                        <select class="form-control custom-selec" name="archive" required="required">
                            <option  disabled="disabled"> Please Select  </option>
                               <option value="1" >Archived</option>
                               <option value="0" >Active</option>
                        </select>
                    </div>
        
                    </div>
                    <!-- /.card-body -->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <a href="#" class="btn btn-secondary float-right">Cancel</a>
                  <input type="submit" value="Update and Save" class="btn btn-success float-left">
                  <input type="hidden" name="Token" value="<?= $rand; ?>" />
                </div>
              </div>
            </form>
            </section>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->
<?          
                
            }
        }
          
   // Footer Set
  if(file_exists($Confing_folder.'footer_local.php')){include_once $Confing_folder.'footer_local.php';} else{die("Footer File is Miss"); }
?>
