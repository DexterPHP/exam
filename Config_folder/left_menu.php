 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">DMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library *** menu-open *** -->
          <li class="nav-item has-treeview"> 
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                document
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="margin-left: 15px;">
              <li class="nav-item ">
                <a href="./add_document.php" class="nav-link ">
                    <i class="far fa-circle nav-icon">
                  </i>
                  <p>Add </p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Inbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="margin-left: 15px;">
                <li class="nav-item">
                    <a href="./search.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Search</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./history.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>User History</p>
                    </a>
                </li>
                
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            View Documents
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="margin-left: 15px;">
                        <li class="nav-item">
                            <a href="./view_doc_list.php?view=owned" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Owned Docs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./view_doc_list.php?view=assigned" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Assigned Docs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./view_doc_list.php?view=depart" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Department Docs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./view_doc_list.php?view=public" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Public Docs</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                
                <!-- <li class="nav-item">
                    <a href="./view_doc_list.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Documents</p>
                    </a>
                </li> -->
              
            </ul>
            </li>

           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                users
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav nav-treeview" style="margin-left: 15px;">
              <li class="nav-item">
                <a href="./add_user.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add user</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./user_search.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Search</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./user_control.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Edit - Delete</p>
                </a>
              </li>

            </ul>
            </li>


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Department
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav nav-treeview" style="margin-left: 15px;">
              <li class="nav-item">
                <a href="./add_department.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New department</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./edit_department.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Edit - Delete</p>
                </a>
              </li>
            </ul>
            </li>

             <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Categories
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav nav-treeview" style="margin-left: 15px;">
              <li class="nav-item">
                <a href="./add_categorie.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add categorie </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./edit_categorie.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Edit - Delete</p>
                </a>
              </li>
            </ul>
            </li>


                  <li class="nav-item has-treeview menu-open">


              <a href="./setting.php" class="nav-link "><i class="nav-icon far fa-control"></i>  Setting </a>


          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
