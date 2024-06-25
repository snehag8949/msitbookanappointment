<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysqli_connect("localhost", "root", "root");
// Selecting Database
$db = mysqli_select_db("project", $connection);
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['email'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query("select email,password from mr where email='$email'", $connection);
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['email'];
if(!isset($login_session)){
mysqli_close($connection); // Closing Connection
header('Location: index2.html'); // Redirecting To Home Page
}
?>