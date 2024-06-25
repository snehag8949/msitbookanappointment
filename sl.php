<?php

//email id password
if( isset($_POST['email']) and isset($_POST['password']) ) {
		include('config.php'); //code is given below (used for database connection)
		$email=$_POST['email'];
		$password=$_POST['password'];
 
		$ret=mysqli_query( $link, "SELECT * FROM sr WHERE email='$email' AND password='$password' ") or die("Could not execute query: " .mysqli_error($conn));
		$row = mysqli_fetch_assoc($ret);
		if(!$row) {
			header("Location: studentdashboard.html");
		}
		else {
	        session_start();
	        $_SESSION['email']=$email;
			header('location: account.php');
		}
}
?>
<html>
<head><title>Login</title>
</head>
<body>
 
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
    //uname-email
	<input type="text" name="email" placeholder="Email ID or Username" required autofocus />
    <input type="text" name="id" placeholder="roll number" required autofocus />
	<input type="password" name="pwd" placeholder="Password" required /> 
	<input type="submit" value="Login" />
</form>
 
</body>
</html>