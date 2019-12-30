<?php

   $search = $DexterC->query("select * from settings where id =1 ") or die(' Faild');
   if($search->num_rows > 0){
       $setting = $search->fetch_object();
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 text-left">
            <h1> Edit Setting </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Setting</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <form method="post" >
        <?php

          $rand = rand(0,999999);
          if(isset($_POST['Token']) && $_POST['Token'] = $rand){
              $upload_folder = filter_var($_POST['upload_folder']);
              if(!is_dir($upload_folder)  ){
                mkdir($upload_folder, 0755, true);
              }
              $email    = filter_var($_POST['email'] ,FILTER_VALIDATE_EMAIL);
              $doc_type = filter_var($_POST['doc_type']);
              $max_size = filter_var($_POST['doc_max_size']    ,FILTER_VALIDATE_INT);

                    // Now Insert To DataBase
            $let_us_update = $DexterC->query('update settings set
            email           = "'.$email.'",
            upload_folder   = "'.$upload_folder.'",
            doc_max_size    = "'.$max_size.'",
            doc_type        = "'.$doc_type.'"
            where id        = 1
        ') or die($DexterC->error.'Error in update user');
        if(isset($let_us_update)){
            echo'
            <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Greate </h5>
                  Success update Setting in our system.
                </div>
            ';

        }



    }




        ?>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title text-left">Edit Setting</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body  text-left">

              <div class="form-group">
                <label for="inputName">Email</label>
                <input required="required" name="email" type="email" id="inputName" class="form-control" min="3" value="<?= htmlspecialchars($setting->email); ?>">
              </div>

              <div class="form-group">
                <label for="inputDescription">Types of documents allowed [ Just add the suffix files you want to allow uploading with a comma "," between them (docx,pdf,) ]</label>
                <input name="doc_type" type="text" id="inputName" class="form-control" min="3" value="<?= htmlspecialchars($setting->doc_type); ?>">
              </div>

               <div class="form-group">
              <label for="inputName">The maximum size of the file that you want to upload [<b style="color:red;">MB</b>]</label>
                <input required="required" name="doc_max_size" type="text" id="inputName" class="form-control" min="3" value="<?= htmlspecialchars($setting->doc_max_size); ?>">
              </div>

            <div class="form-group">
              <label for="inputName">The path of the folder to which you want to upload documents ( it will be created if it does not exist )</label>
                <input required="required" name="upload_folder" type="text" id="inputName" class="form-control" min="3" value="<?= $setting->upload_folder; ?>">
              </div>

               </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

      </div>
      <div class="row">
        <div class="col-12">
          <a href="#" class="btn btn-secondary float-right">Cancel</a>
          <input type="submit" value="update " class="btn btn-success float-left">
          <input type="hidden" name="Token" value="<?= $rand; ?>" />
        </div>
      </div>
    </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
   }

