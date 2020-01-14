<?php
session_start();
 require('connect.php');
  date_default_timezone_set("Asia/Kolkata");


$log_time=date("Y-m-d  H:i:s", time());

$ip =  $_SERVER['REMOTE_ADDR'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Techroutes Technical Support</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Customer Login</div>
      <div class="card-body">
      <form action="customer_login.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input class="form-control" id="exampleInputEmail1" type="text" name="username" aria-describedby="emailHelp" placeholder="Username or email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" name="password" type="password" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div>
          </div>
              <input type="submit" value="Login" class="btn btn-primary btn-block" name="search">

        </form>
        <div class="text-center">
          <!--<a class="d-block small mt-3" href="register.html">Register an Account</a>-->
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<?php  //Start the Session
session_start();
 require('connect.php');

if (isset($_POST['username']) and isset($_POST['password']))
{
//3.1.1 Assigning posted values to variables.
$username = $_POST['username'];
$password = $_POST['password'];
//3.1.2 Checking the values are existing in the database or not
$query = "select * from  customer where username='$username' and password='$password'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$row  = mysqli_fetch_array($result);
if(is_array($row)) {
	$_SESSION["customer_id"] = $row['customer_id'];
       $_SESSION["customer_name"] = $row['customer_name'];
$cus_name=$row['customer_name'];


//$Sql="insert into  visitor_logs (time,ipaddr,name,action) VALUES('$log_time','$ip','$cus_name','login') ";

//$result=mysqli_query($con,$Sql);

echo "login sucess";
echo "<script language='javascript' type='text/javascript'> location.href='main.php' </script>";



	} 
else
{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
echo "<script type='text/javascript'>alert('User Name Or Password Invalid!')</script>";

$Sql1="insert into  unauthoriz (time,ipaddr,username,password,status) VALUES('$log_time','$ip','$username','$password','login_failed') ";
$result1=mysqli_query($con,$Sql1);

}
}
?>
</body>

</html>
