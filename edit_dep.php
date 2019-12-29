<?php
if(isset($_GET['id'])){
    $us_id = intval($_GET['id']);
   $search = $DexterC->query("select * from department where id =".$us_id." ") or die(' Faild');
   if($search->num_rows > 0){
       $dep_date = $search->fetch_object();
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 text-left">
            <h1> Edit  [ <?= htmlspecialchars($dep_date->depart_title); ?>]</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Departments</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <form method="post">
        <?php

          $rand = rand(0,999999);
          if(isset($_POST['Token']) && $_POST['Token'] = $rand){
              $dep_name = filter_var($_POST['depart_title'],FILTER_SANITIZE_STRING);

                    // Now Insert To DataBase
           $let_us_update = $DexterC->query('update department set
            depart_title = "'.$dep_name.'"
            where id   =  '.$dep_date->id.'
        ') or die($DexterC->error.'Error in update user');
        if(isset($let_us_update)){
            echo'
            <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Cool </h5>
                  Success update department in our system.
                </div>
            ';

        }



    }




        ?>




   <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title text-left">update Department </h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body  text-left">
              <div class="form-group">
                <label for="inputName">  Department Title</label>
                <input required="required" value="<?= $dep_date->depart_title; ?>" name="depart_title" type="text" id="inputName" class="form-control" min="3">
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