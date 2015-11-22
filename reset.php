<?php
include('db.php');
if(isset($_GET['action']))
{          
    if($_GET['action']=="reset")
    {
        $encrypt = mysqli_real_escape_string($connection,$_GET['encrypt']);
        $query = "SELECT id FROM users where md5(90*13+id)='".$encrypt."'";
        $result = mysqli_query($connection,$query);
        $Results = mysqli_fetch_array($result);
        if(count($Results)>=1)
        {

        }
        else
        {
            $message = 'Invalid key please try again. <a href="http://demo.phpgang.com/login-signup-in-php/#forget">Forget Password?</a>';
        }
    }
}
elseif(isset($_POST['action']))
{
    
    $encrypt      = mysqli_real_escape_string($connection,$_POST['action']);
    $password     = mysqli_real_escape_string($connection,$_POST['password']);
    $query = "SELECT id FROM users where md5(90*13+id)='".$encrypt."'";
//    echo $query;
    $result = mysqli_query($connection,$query);
    $Results = mysqli_fetch_array($result);
    if(count($Results)>=1)
    {
        $query = "update users set password='".md5($password)."' where id='".$Results['id']."'";
        mysqli_query($connection,$query);
//        echo $query;
        $message = "Your password changed sucessfully <a href=\"http://demo.phpgang.com/login-signup-in-php/\">click here to login</a>.";
    }
    else
    {
        $message = 'Invalid key please try again. <a href="http://demo.phpgang.com/login-signup-in-php/#forget">Forget Password?</a>';
    }
}
else
{
    header("location: /login-signup-in-php");
}


$content ='<script type="text/javascript" src="jquery-1.8.0.min.js"></script> 
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<style type="text/css">
input[type=password]
{
  border: 1px solid #ccc;
  border-radius: 3px;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  width:200px;
  min-height: 28px;
  padding: 4px 20px 4px 8px;
  font-size: 12px;
  -moz-transition: all .2s linear;
  -webkit-transition: all .2s linear;
  transition: all .2s linear;
}
input[type=password]:focus
{
  width: 400px;
  border-color: #51a7e8;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1),0 0 5px rgba(81,167,232,0.5);
  outline: none;
}
</style>  
  <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
function mypasswordmatch()
{
    var pass1 = $("#password").val();
    var pass2 = $("#password2").val();
    if (pass1 != pass2)
    {
        alert("Passwords do not match");
        return false;
    }
    else
    {
        $( "#reset" ).submit();
    }
}
  </script>
</head>
<body>
 <b>'.$message.'</b>
<div id="tabs" style="width: 480px;">
  <ul>
    <li><a href="#tabs-1">Reset Password</a></li>
    
    
  </ul>                 
  <div id="tabs-1">
  <form action="reset.php" method="post" id="reset" >
    <p><input id="password" name="password" type="password" placeholder="Enter new password">
    <p><input id="password2" name="password2" type="password" placeholder="Re-type new password">
    <input name="action" type="hidden" value="'.$encrypt.'" /></p>
    <p><input type="button" value="Reset Password" onclick="mypasswordmatch();" /></p>
  </form>
  </div>
</div>';


$pre = 1;
$title = "How to create Login and Signup form in PHP";
$heading = "How to create Login and Signup form in PHP.";
include("html.inc");            
?>