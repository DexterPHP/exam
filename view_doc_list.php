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

/****************************************************
*          retrieving the documents needed 
* ***************************************************/
if (isset($_GET['view']))
{
    if($_GET['view'] == 'owned')
    {
        $user = base64_decode($_SESSION['userToken']);
        //echo var_dump ($user);
        $owner = $DexterC->query('select * from admin_acccount where u_name_s ="'.$user.'" limit 1') or die('Someting went wrong');
        $num = $owner->num_rows;
        if($num > 0 )
        {
            $data_user = $owner->fetch_object();
            $user_id = intval($data_user->numb);
            //echo var_dump($user_id);
            $sea_sql = $DexterC->query('select * from documents where owner ="'.$user_id.'" AND doc_type ="Private" order by id desc') or die('[^__OO__^]');
            $table_title = "Owned";
        }
    }
    elseif($_GET['view'] == 'assigned')
    {
        $sea_sql = $DexterC->query("select * from documents order by id desc") or die('[^__OO__^]');
        $table_title = "Assigned";
    }
    elseif($_GET['view'] == 'depart')
    {
        $sea_sql = $DexterC->query("select * from documents order by id desc") or die('[^__OO__^]');
    }
    elseif($_GET['view'] == 'public')
    {
        $sea_sql = $DexterC->query("select * from documents where doc_type ='Public' order by id desc") or die('[^__OO__^]');
    }
}
else 
{

}
?>
<div class="content-wrapper" style="min-height: 1015.13px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List of <?php echo strtolower($table_title) ?> Documents</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $table_title ?> Documents</li>
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
                        <h3 class="card-title"><?php echo $table_title ?> Documents</h3>
                    </div>
                    <!-- /.card-header -->
                    <?php  
                    if (isset($_GET['view'])&& $_GET['view'] == 'assigned')
                    { ?>
                        <table align="center" style="margin-top:25px;">
                            <tr>
                                <td style="padding-right:120px;">
                                    <div class="radio">
                                        <input id="first" name="Type" type="radio" value="department" checked >
                                        <label for="first-1" class="radio-label" >Department</label>
                                    </div>
                                </td>
                                <td style="padding-right:120px;">
                                    <select class="form-control custom-selec" id="select_depart" name="depart" required="required" disabled>
                                        <option   disabled="disabled"> Please Select  </option>
                                        <?php
                                        $Depart = $DexterC->query("select * from department order by depart_title asc") or die();
                                        while($dapart_data = $Depart->fetch_object())
                                        {
                                            echo"<option value=".$dapart_data->id." >".htmlspecialchars($dapart_data->depart_title)."</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td style="padding-right:120px;">
                                    <div class="radio">
                                        <input id="third" name="Type" type="radio" value="user" >
                                        <label for="third" class="radio-label" >User</label>
                                    </div>
                                </td>
                                <td>
                                    <select class="form-control custom-selec" id="select_user" name="user" required="required" disabled>
                                        <option   disabled="disabled"> Please Select  </option>
                                            <?php
                                            $users = $DexterC->query("select * from owners order by owner_name asc") or die();
                                            while($users_data = $users->fetch_object())
                                            {
                                                echo"<option value=".$users_data->id." >".$users_data->owner_name."</option>";
                                            }
                                            ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        
                    <?php
                    }
                    
                    ?>
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
                                            <th>Type</th>
                                            <!--<th>Category</th>
                                            <th>Department</th>
                                            <th>Type</th>
                                            <th>Description</th> -->
                                            <th>Control</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($sea_sql->num_rows > 0)
                                                {
                                                    while ($docx  = $sea_sql->fetch_object()){
                                                    if(isset($docx->id)) {
                                                        $owner_sql  = $DexterC->query("select * from owners where id = '".intval($docx->owner)."'") or die('[^__OO__^]');
                                                        $cater_sql  = $DexterC->query("select * from category where id = '".intval($docx->cater_id)."'") or die('[^__OO__^]');
                                                        $depart_sql = $DexterC->query("select * from department where id = '".intval($docx->depart)."'") or die('[^__OO__^]');
                                                        $ownerx     = $owner_sql->fetch_object();
                                                        $categoryx  = $cater_sql->fetch_object();
                                                        $departx    = $depart_sql->fetch_object();
                                                        echo'
                                                            <tr role="row" class="even ">
                                                               <td>'.$docx->id.'</td>
                                                                <td class="sorting_1">'.$docx->title.'</td>
                                                                <td>'.$ownerx->owner_name.'</td>
                                                                <td>'.$docx->doc_type.'</td>
                                                                <td>
                                                                    <div class="btn-group-vertical">
                                                                        <div class="btn-group">
                                                                            <a href="document_edit.php?doc='.$docx->id.'"> <i class="fa fa-edit"></i></a>
                                                                            <a onclick="javascript: return confirm(\'Please confirm deletion\');" href="delete_document.php?doc='.$docx->id.'" style="color: #BF0A30;"><i class="fa fa-trash" aria-hidden="true" style="margin-left:5px;margin-right:5px;"></i> </a>  
                                                                            <a onclick="javascript: return confirm(\'Please confirm Archive action\');" href="view_doc_list.php?doc='.$docx->id.'" style="color: green;"><i class="fa fa-archive" aria-hidden="true"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                            <td colspan="5">
                                                                <table class="text-center table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                                                    <thead>
                                                                        <tr role="row">
                                                                            <th>Comment</th>
                                                                            <th>Category</th>
                                                                            <th>Department</th>
                                                                            <th>Description</th>
                                                                            <th>Link</th>
                                                                        </tr>
                                                                        </thead>
                                                                    <tr>
                                                                        <td>'.$docx->commnt.'</td>
                                                                        <td>'.$categoryx->center_name.'</td>
                                                                        <td>'.$departx->depart_title.'</td>
                                                                        <td>'.$docx->desc_text.'</td>
                                                                        <td>'.$docx->file_link.'</td>
                                                                        
                                                                        
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                                    
                                                            </tr>';
                                                        }
                                                    }
                                                                        echo'
                                                                        </tbody>
                                
                                                                       <!-- <tfoot>
                                                                        <tr role="row">
                                                                            <th style="width: 101px;">ID</th>
                                                                            <th>Title</th>
                                                                            <th>Owner</th>
                                                                            <th>Type</th>
                                                                             <th>Category</th>
                                                                            <th>Department</th>
                                                                            <th>Type</th>
                                                                            <th>Description</th> 
                                                                            <th>Control</th>
                                                                        </tr>
                                                                        </tfoot>-->

                                            ';
                                
                                        }else{
                                            echo'No data Found';
                                        }
                                        ?>  </tbody>
                                        </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
</section>
<!-- /.content -->
</div>        <!-- /.col -->

<!-- /.row -->


<?php
   // Footer Set
  if(file_exists($Confing_folder.'footer_local.php')){include_once $Confing_folder.'footer_local.php';} else{die("Footer File is Miss"); }
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  
<script>
/***********************************************************/
$(document).ready(function () 
 { 
    $('input[type="radio"]').click(function() {
       if($(this).attr('id') == 'first') 
       {
            $('#select_depart').prop('disabled', false);   
            $('#select_user').prop('disabled', true);
       }

       else {
            $('#select_depart').prop('disabled', true);   
            $('#select_user').prop('disabled', false);
       }
   });
});

</script>
