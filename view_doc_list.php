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

<div class="content-wrapper" style="min-height: 1015.13px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List of Documents</h1>
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
        <div class="row">
            <div class="col-12">


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Documents</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <a href="add_document.php" class="float-left"> <button type="button" class="btn btn-info">New Document</button></a>&nbsp;&nbsp;&nbsp;
                                <a href="search.php" class="float-right"><button type="button" class=" btn bg-gradient-success ">Search</button></a>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="text-center table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                        <thead>
                                        <tr role="row">
                                            <th style="width: 101px;">ID</th>
                                            <th>Title</th>
                                            <th>Owner</th>
                                            <th>Comment</th>
                                            <th>Category</th>
                                            <th>Department</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Control</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        $sea_sql = $DexterC->query("select * from documents order by id desc") or die('[^__OO__^]');
                                                if($sea_sql->num_rows > 0)
                                                {
                                                    while ($docx  = $sea_sql->fetch_object()){
                                                    if(isset($docx->id)) {
                                                        echo'
                                                            <tr role="row" class="even ">
                                                            <td>'.$docx->id.'</td>
                                                            <td class="sorting_1">'.$docx->title.'</td>';
                                
                                            $owner_sql  = $DexterC->query("select * from owners where id = '".intval($docx->owner)."'") or die('[^__OO__^]');
                                            $cater_sql  = $DexterC->query("select * from category where id = '".intval($docx->cater_id)."'") or die('[^__OO__^]');
                                            $depart_sql = $DexterC->query("select * from department where id = '".intval($docx->depart)."'") or die('[^__OO__^]');
                                            $ownerx     = $owner_sql->fetch_object();
                                            $categoryx  = $cater_sql->fetch_object();
                                            $departx    = $depart_sql->fetch_object();
                                                                            echo '
                                                                                <td>'.$ownerx->owner_name.'</td>
                                                                                <td>'.$docx->commnt.'</td>
                                                                                <td>'.$categoryx->center_name.'</td>
                                                                                <td>'.$departx->depart_title.'</td>
                                                                                <td>'.$docx->doc_type.'</td>
                                                                                <td>'.$docx->desc_text.'</td>
                                                                                <td>
                                                                                    <div class="btn-group-vertical">
                                                                                        <div class="btn-group">
                                                                                            <a href="document_edit.php?doc='.$docx->id.'"> Edit </a> - 
                                                                                            <a href="delete_document.php?doc='.$docx->id.'" style="color: #BF0A30;"><i> Delete</i> </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>';
                                                                            }
                                                                        }
                                                                        echo'
                                                                        </tbody>
                                
                                                                        <tfoot>
                                                                        <tr role="row">
                                                                            <th style="width: 101px;">ID</th>
                                                                            <th>Title</th>
                                                                            <th>Owner</th>
                                                                            <th>Comment</th>
                                                                            <th>Category</th>
                                                                            <th>Department</th>
                                                                            <th>Type</th>
                                                                            <th>Description</th>
                                                                            <th>Control</th>
                                                                        </tr>
                                                                        </tfoot>
                                                                    </table>
                                            ';
                                
                                        }else{
                                            echo'No data Found';
                                        }
                                        ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>

<?
   // Footer Set
  if(file_exists($Confing_folder.'footer_local.php')){include_once $Confing_folder.'footer_local.php';} else{die("Footer File is Miss"); }
?>
