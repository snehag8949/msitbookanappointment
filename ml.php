<?php
// Include config file
require_once "config.php";
include('process.php');
session_start();
// Define variables and initialize with empty values
$email  = $password = "";
$email_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
   $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter your email.";
    }  else{
        $email = $input_email;
    } 

    //Validate password
    $input_password = trim($_POST["password"]);
    if(empty($input_password)){
        $password_err = "Please enter your password.";
    } elseif(!filter_var($input_password, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $password_err = "Please enter a valid password.";
    } else{
        $password = $input_password;
    }
    
    
    
// Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) ){
        // Prepare an insert statement
             
        $sql = "SELECT email, password FROM mr WHERE email = '".$email."' && password = '".$password."'";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_email,$param_password);
            
            // Set parameters
            $param_email        = $email;         
            $param_password     = $password;
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to list of appointments
                header("location: loa.html");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
    //    mysqli_stmt_close($stmt);
    }
} 
    // Close connection
    mysqli_close($link);

?> <!DOCTYPE html>
<html lang="en">
<head>
  <title>MSIT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   
 </head>
<body>

<br>
<br>
<!--<script type="text/javascript">
function checkMailStatus(){
    //alert("came");
var email=$("#email").val();// value in field email
$.ajax({
    type:'post',
        url:'checkMail.php',// put your real file name 
        data:{email: email},
        success:function(msg){
        alert(msg); // your message will come here.     
        }
 });
}
</script>-->
<!---Nav Bar---->
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index2.html">Home</a>
            </li>
            <ul class="navbar-nav">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Mentors
      </a>
      <div class="dropdown-menu">
        <!--<a class="dropdown-item" href="mr.php">Register</a>-->
        <a class="dropdown-item" href="ml.php">Login</a>
        </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="http://msitprogram.net/index.php">About Us</a>
    </li>
  </ul>
    </ul>
    
    </div>
    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <form class="form-inline" action="https://www.google.com/">
    <input class="form-control mr-sm-2" type="text" placeholder="Search">
    <button class="btn btn-success" type="submit">Search</button>
     </form>


</nav>
        </ul>
    </div>

</nav>
<!--Nav bar-->
<!---Main frame--->
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="page-header">
                       <center><h2>Login</h2></center> 
                    </div>
                    <!--<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">-->
                    <form action="validate.php" method="post">
                        
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                                          
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                            <span class="help-block"><?php echo $password_err;?></span>
                        </div>
                        
                        <br>
                        <br>
                        <center> <a href="mentordashboard.html" class="btn btn-primary" name="login" value="ogin">Submit</a>
                           
                      <!--  <a href="mr.php" class="btn btn-default">Cancel</a>
                         <a href="reset.html" class="btn btn-primary">Reset Password</a> --></center>
                    </form>
                
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
