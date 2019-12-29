<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 text-left">
            <h1> Search</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />
    <!-- Main content -->
    <section class="content">
    <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
        <thead>
            <tr>
                <th>user id</th>
                <th>userName</th>
                <th>Info</th>
                <th>Rols</th>
                <th>Department</th>
                <th>Control</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $all_users = $DexterC->query("select * from owners order by owner_name asc") or die('Cool');
            while($user = $all_users->fetch_object()){
               echo'
            <tr>
                <td>'.$user->id.'</td>
                <td>'.$user->owner_name.'</td>
                <td>'.$user->owner_desc.'</td>
                <td>'.GetRoleTitle($user->owner_type).'</td>
                <td>'.GetDepartTitle($user->depart_id).'</td>
                <td><a href="view.php?id='.$user->id.'">Control</a></td>
            </tr>';
            }
            ?>

        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
    </table>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



