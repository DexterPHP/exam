<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 text-left">
            <h1> New Document</h1>
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
              $owner_pass = strip_tags(addslashes(trim(md5(md5(md5(sha1($_POST['password'])))))));
              $owner_desc = filter_var($_POST['owner_desc'] ,FILTER_SANITIZE_STRING);
              $owner_rols = filter_var($_POST['rols']   ,FILTER_VALIDATE_INT);
              $user_depat = filter_var($_POST['depart_id']    ,FILTER_VALIDATE_INT);
              $is_user = $DexterC->query('select * from owners where owner_name="'.$owner_name.'" limit 1') or die('o__O');

                    if($is_user->num_rows > 0){
                        echo'

                       <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Stop </h5>
                  user Alerdy in the system.
                </div>';

              } else{
                    // Now Insert To DataBase
        $let_us_insert = $DexterC->query('insert into owners
        (`owner_name`, `password`, `depart_id`, `owner_type`, `owner_desc`) Values
        ("'.$owner_name.'","'.$owner_pass.'","'.$owner_desc.'",'.$owner_rols.','.$user_depat.')
        ') or die('Error in add user');
        if(isset($let_us_insert)){
            echo'
            <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Cool </h5>
                  Success Add new User  To our system.
                </div>
            ';

        }
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
                <input required="required" name="owner_name" type="text" id="inputName" class="form-control" min="3">
              </div>
              <div class="form-group">
                <label for="inputDescription">password</label>
                <input required="required" name="password" type="password" id="inputName" class="form-control" min="3">
              </div>
               <div class="form-group">
              <label for="inputName">owner Info</label>
                <input required="required" name="owner_desc" type="text" id="inputName" class="form-control" min="3">
              </div>
              <div class="form-group">
                <label for="inputClientCompany">Rols</label>
                <select class="form-control custom-selec" name="rols" required="required">
                    <option   disabled="disabled"> Please Select  </option>
                   <?php
                   $rols = $DexterC->query("select * from user_rols order by rols_title asc") or die();
                   while($rols_data = $rols->fetch_object()){
                       echo'<option value="'.$rols_data->id.'" >'.htmlspecialchars($rols_data->rols_title).'</option>';

                   }
                   ?>
                </select>
              </div>

              <div class="form-group">
                <label for="inputStatus">Department</label>
                <select class="form-control custom-selec" name="depart_id" required="required">
                    <option   disabled="disabled"> Please Select  </option>
                   <?php
                   $Depart = $DexterC->query("select * from department order by depart_title asc") or die();
                   while($dapart_data = $Depart->fetch_object()){
                       echo'<option value="'.$dapart_data->id.'" >'.htmlspecialchars($dapart_data->depart_title).'</option>';

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
          <input type="submit" value="Upload And Add Now" class="btn btn-success float-left">
          <input type="hidden" name="Token" value="<?= $rand; ?>" />
        </div>
      </div>
    </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
