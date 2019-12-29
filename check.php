<?php
ob_start();
session_start();
   if(file_exists("./Config_folder/connaction_classic.php")){

    include_once "./Config_folder/connaction_classic.php";

 if(isset($_POST['setuser']) &&  isset($_POST['setpass'])){
      // Login

        $useridn 	= strip_tags(addslashes(trim($_REQUEST['setuser'])));
		$upasswordn = strip_tags(addslashes(trim(md5(md5(md5(sha1($_REQUEST['setpass'])))))));
        if(empty($useridn) or strlen($useridn) < 3)
        { echo '
                <div class="alert alert-danger background-danger">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="icofont icofont-close-line-circled text-white"></i>
    </button>
    <strong>Alert!</strong>incorrect UserName
</div>

        ';}
        else if(empty($upasswordn) or strlen($upasswordn) < 3)
        {
            echo'<div class="alert alert-danger background-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <i class="icofont icofont-close-line-circled text-white"></i>
                </button>
                <strong>Alert!</strong>incorrect Password
            </div>
            ';
        }

        else
        {

		$t2= $GLOBALS['database']->getConnection()->query("select * from admin_acccount where u_name_s='".$useridn."' && u_pass_s='".$upasswordn."'LIMIT 1") or die ("Error");
        $x = $t2->num_rows;

		if(!empty($x)  && $x > 0 && $x < 2)
		{
			echo '
            <div class="alert alert-info background-info">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled text-white"></i>
                </button>   &nbsp;
                <strong> Welcome</strong> '.$useridn.'&nbsp;</code>Welcome  To Control Panel&nbsp;
            </div>';
  echo'
<script type="text/javascript">
window.setTimeout (
function(){
  window.location.href = "index.php";
  }, 2000
);
</script>
';


                 $fxu = base64_encode($useridn);
                 $fxp = base64_encode($upasswordn);
           // setcookie('pass',$fxm,time()+43200);        // 60 Secand * 60 menut * 2 houre  = 7200 Secand
           // setcookie('user',$upasswordn,time()+86400);   // 60 Secand * 60 menut * 2 houre  = 7200 Secand
            $_SESSION['userToken'] = $fxu;
            $_SESSION['PassToken'] = $fxp;

            echo'
<script type="text/javascript">
window.setTimeout (
function(){
  window.location.href = "index.php";
  }, 1000
);
</script>
';

		}
		else    // not available
		{
			echo '
            <div class="alert alert-danger background-danger">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="icofont icofont-close-line-circled text-white"></i>
    </button>
    <strong>OOPS!</strong>   Invaild UserName Or PassWord Please Try again.
</div>

                ';
                header('Location:'.'login-page.php');
		}
        }

      // Login
  }

   else if (!isset($_SESSION['userToken']) && !isset($_SESSION['PassToken']))
  {
    header('Location:'.'login-page.php');
    exit('forbidden');
  }

  else if (isset($_SESSION['userToken']) && isset($_SESSION['PassToken']))
  {
    $user = base64_decode($_SESSION['PassToken']) ;  //pass
    $pass = base64_decode($_SESSION['userToken']);    //user
    //$chack = mysql_query("select * from admin_acccount where  numb=1 LIMIT 1")or die("Error");
    $chack = $GLOBALS['database']->getConnection()->query("select * from admin_acccount where u_name_s='".$pass."' && u_pass_s='".$user."' && numb=1 or numb=2 LIMIT 1")or die("Error");
    $x = $chack->num_rows;
    if(empty($x)  && $x <= 0 && $x > 1)
    {
      /*
      setcookie('user',$pass,time()-86400);
      setcookie('pass',$user,time()-43200);
      */
      unset($_SESSION['userToken'],$_SESSION['PassToken']) ;
      header('Location:'.'login-page.php');
    }



  }
  else if (isset($_SESSION['userToken']))
  {
    header('Location:'.'login-page.php');
  }
  else if (isset($_SESSION['PassToken']))
  {
    header('Location:'.'login-page.php');
  }


}
  else{die();}
  ?>