<?php
if(isset($_GET['id'])){
    $us_id = intval($_GET['id']);
   $search = $DexterC->query("select * from owners where id =".$us_id." ") or die(' Faild');
   if($search->num_rows > 0){
       $user_date = $search->fetch_object();
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 text-left">
            <h1> Edit User [ <?= htmlspecialchars($user_date->owner_name); ?>]</h1>
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

          $rand = rand(0,999999);
          if(isset($_POST['Token']) && $_POST['Token'] = $rand){
              $owner_name = filter_var($_POST['owner_name'],FILTER_SANITIZE_STRING);
              if(strlen($_POST['password']) > 3 ){
                $owner_pass = strip_tags(addslashes(trim(md5(md5(md5(sha1($_POST['password'])))))));
              }else{
                $owner_pass =  $user_date->password;
              }
              $owner_desc = filter_var($_POST['owner_desc'] ,FILTER_SANITIZE_STRING);
              $owner_rols = filter_var($_POST['rols']   ,FILTER_VALIDATE_INT);
              $user_depat = filter_var($_POST['depart_id']    ,FILTER_VALIDATE_INT);

                    // Now Insert To DataBase
           $let_us_update = $DexterC->query('update owners set
            owner_name = "'.$owner_name.'",
            password   = "'.$owner_pass.'",
            owner_desc = "'.$owner_desc.'",
            owner_type =  '.$owner_rols.',
            depart_id  =  '.$user_depat.'
            where id   =  '.$user_date->id.'
        ') or die($DexterC->error.'Error in update user');
        if(isset($let_us_update)){
            echo'
            <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Cool </h5>
                  Success update User in our system.
                </div>
            ';

        }



    }




        ?>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title text-left">Add New User </h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body  text-left">
              <div class="form-group">
                <label for="inputName">  User Name</label>
                <input required="required" name="owner_name" type="text" id="inputName" class="form-control" min="3" value="<?= htmlspecialchars($user_date->owner_name); ?>">
              </div>
              <div class="form-group">
                <label for="inputDescription">password [ Leave this field blank if you do not want to change this user's password ]</label>
                <input name="password" type="password" id="inputName" class="form-control" min="3">
              </div>
               <div class="form-group">
              <label for="inputName">owner Info</label>
                <input required="required" name="owner_desc" type="text" id="inputName" class="form-control" min="3" value="<?= htmlspecialchars($user_date->owner_desc); ?>">
              </div>
              <div class="form-group">
                <label for="inputClientCompany">Rols</label>
                <select class="form-control custom-selec" name="rols" required="required">
                    <option   disabled="disabled" > Please Select  </option>
                   <?php
                   $rols = $DexterC->query("select * from user_rols order by rols_title asc") or die();
                   $a = ' ';
                   while($rols_data = $rols->fetch_object()){
                       if($user_date->owner_type == $rols_data->id){
                           $a= 'selected="selected"';
                       }
                       echo'<option '.$a.' value="'.$rols_data->id.'" >'.htmlspecialchars($rols_data->rols_title).'</option>';

                   }
                   ?>
                </select>
              </div>

              <div class="form-group">
                <label for="inputStatus">Department</label>
                <select class="form-control custom-selec" name="depart_id" required="required">
                    <option   disabled="disabled"> Please Select  </option>
                   <?php
                   $b=' ';
                   $Depart = $DexterC->query("select * from department order by depart_title asc") or die();
                   while($dapart_data = $Depart->fetch_object()){
                        if($user_date->depart_id == $dapart_data->id){
                           $b = 'selected="selected"';
                       }
                       echo'<option '.$b.' value="'.$dapart_data->id.'" >'.htmlspecialchars($dapart_data->depart_title).'</option>';

                   }
                   ?>
                </select>
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
}

else{
    echo 'Stop !! Not Found ';
}