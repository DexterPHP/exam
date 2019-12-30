<?php
if(isset($_GET['id'])){
    $us_id = intval($_GET['id']);
   $search = $DexterC->query("select * from category where id =".$us_id." ") or die(' Faild');
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
            <h1> Delete category [ <?= htmlspecialchars($dep_date->center_name); ?>]</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">


      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title text-left">This category Has been Deleted</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body  text-left">
                <?php


                    // Now Insert To DataBase
           $let_us_update = $DexterC->query('Delete from category where id   =  '.$dep_date->id.' ') or die('Error in delete Dep');
        if(isset($let_us_update)){
            echo'
            <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Cool </h5>
                  Success Delete  category From system.
                </div>

                <meta http-equiv="refresh" content="2; url=./edit_categorie.php">
            ';

        }


        ?>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
   }
   else{
    echo '
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
     <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-stop"></i>Wait Second </h5>
                  Stop !! Not Found
                </div>
                </div>
                </div>
                </div>
                <meta http-equiv="refresh" content="2; url=./edit_categorie.php">
    ';
}
}

else{
    echo 'Stop !! Not Found ';
}