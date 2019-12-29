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
              <li class="breadcrumb-item active">department</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />
    <!-- Main content -->
    <section class="content">
    <table id="example" class="table table-striped table-bordered text-center" width="99%">
        <thead>
            <tr>
                <th>department id</th>
                <th>department Title</th>
                <th>Control</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $all_dep = $DexterC->query("select * from department order by depart_title asc") or die('Cool');
            while($dep = $all_dep->fetch_object()){
               echo'
            <tr>
                <td>'.$dep->id.'</td>
                <td>'.$dep->depart_title.'</td>

                <td>
                    <a href="edit_depart.php?id='.$dep->id.'">Edit </a> &nbsp; - &nbsp;
                    <a onclick="javascript: return confirm(\'Please confirm deletion\');" href="./delete_depa.php?id='.$dep->id.'"><i class="material-icons" style="color:#BF0A30">Delete</i></a>
                </td>
            </tr>';
            }
            ?>

        </tbody>
        <tfoot>
            <tr>
                <th>department id</th>
                <th>department Title</th>
                <th>Control</th>
            </tr>
        </tfoot>
    </table>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



