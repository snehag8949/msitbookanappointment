<?php 
  $db = mysqli_connect('localhost', 'root', 'root', 'project');
  
  if (isset($_POST['email'])) {
  	$email = $_POST['email'];
  	$sql = "SELECT * FROM mr WHERE email='$email'";
  	$results = mysqli_query($db, $sql);
  	if (mysqli_num_rows($results) > 0) {
  	  echo "Email Exists";
        header('refresh:5;url=mr.php');
  	}else{
  	  echo "Email doesn't exist.Try to login.";
        header('refresh:5;url=ml.php');
  	}
  	exit();
  }
if (isset($_POST['password'])) {
  	$password = $_POST['password'];
  	$sql = "SELECT password FROM mr WHERE password='$password'";
  	$results = mysqli_query($db, $sql);
  	if (mysqli_num_rows($results) > 0) {
  	  echo "Password Already Exists";
        header('refresh:5;url=mr.php');
  	}else{
  	  echo "Password doesn't exist.Try to login.";
        header('refresh:5;url=ml.php');
  	}
  	exit();
  }
  if (isset($_POST['save'])) {
  	//$username = $_POST['username'];
  	$email = $_POST['email'];
  	$password = $_POST['password'];
  	$sql = "SELECT * FROM mr WHERE email='$email'";
  	$results = mysqli_query($db, $sql);
  	if (mysqli_num_rows($results) > 0) {
  	  echo "exists";	
  	  exit();
  	}else{
  	  $query = "INSERT INTO mr (email, password) 
  	       	VALUES ('$email', '".md5($password)."')";
  	  $results = mysqli_query($db, $query);
  	  echo 'Saved!';
  	  exit();
  	}
  }

?>