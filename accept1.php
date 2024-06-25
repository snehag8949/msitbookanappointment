<?php
// Include config file
$link = mysqli_connect("localhost","root","root","project");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
else
{
    echo "Connected successfully";
}
// Define variables and initialize with empty values
$teamno = $status = $comments  = "";
$teamno_err = $status_err = $comments_err = "";
// Processing form data when form is submitted
if(isset($_POST["teamno"]) && !empty($_POST["teamno"])){
    // Get hidden input value
    $teamno = $_GET["teamno"];
    
    // Validate Teamno
    $input_teamno = trim($_POST["teamno"]);
    if(empty($input_teamno)){
        $teamno_err = "Please enter Team no.";     
    } else{
        $teamno = $input_teamno;
    }
 
    
    //Validate date
    $input_status = trim($_POST["status"]);
    if(empty($input_status)){
        $status_err = "Please enter your status.";
    }  else{
        $status = $input_status;
    }
    
    //Validate time
    $input_comments = trim($_POST["comments"]);
    if(empty($input_comments)){
        $comments_err = "Please enter comments";
    }  else{
        $comments = $input_comments;
    }
    $teamno=$_GET['teamno'];
      // Check input errors before inserting in database
    if(empty($status_err) && empty($comments_err)){
        // Prepare an update statement
        $sql = "UPDATE sbook SET status=? comments=? WHERE teamno=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssi",$param_status, $param_comments,$param_teamno);
            
            // Set parameters
            
            $param_status       = $status;
            $param_comments     = $comments;
            $param_teamno       = $teamno;
           
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to sbook.php
                header("location: sbook2.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>List Of Courses</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
    div
        {
            margin:20px;
        }    </style>
 </head>
<body>
<br>
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
        <a class="dropdown-item" href="mr.php">Register</a>
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
  <form class="form-inline" action="/action_page.php">
    <input class="form-control mr-sm-2" type="text" placeholder="Search">
    <button class="btn btn-success" type="submit">Search</button>
  </form>
<!--Profile dropdown-->
<div> 
    <button class="btn btn-success" type="submit"><a href="index2.html">LogOut</a></button>
</div>                
<!--Profile dropdown-->

</nav>
</ul>
</div>
</nav>
<!--Nav bar-->
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Status of the Applicants</h2>
                      <!--  <a href="create.php" class="btn btn-success pull-right">Add New Team</a>-->
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                  
                    $sql = "select * from sbook";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Team Number</th>";
                                        echo "<th>Project Title</th>";
                                        echo "<th>Date</th>";
                                        echo "<th>Time</th>";
                                        echo "<th>Status of the Applicants</th>";
                                        echo "<th>Comments</th>";
                                    echo "</tr>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['teamno'] . "</td>";
                                        echo "<td>" . $row['ptitle'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>" . $row['time'] . "</td>";
                                       
                                    ?>
<html>                                 
   <form method="post" class="table_content_form"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <td class="table_content">
    
       <div class="form-group <?php echo (!empty($status_err)) ? 'has-error' : ''; ?>">
            <label for="status"></label><span style="color: red !important; display: inline; float: none;"></span>
                        
                        <select name="status" class="form-control">
                            <option value="">None</option>
                            <option value="Accepted">Accepted</option>
                            <option value="Denied">Denied</option>
                            <option value="Reschedule">Reschedule</option>
                        </select>
        </div>
     </td> 
    
                    
                        
    <td class="table_content">
    <!--<form method="post" class="table_content_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">-->
       <div class="form-group <?php echo (!empty($comments_err)) ? 'has-error' : ''; ?>">
            <textarea name="comments" class="form-control"><?php echo $comments; ?></textarea>
                <span class="help-block"><?php echo $comments_err;?></span>
       </div>
        
        <center>
                    <a href="index2.html"><input type="button" name="Submit" class="btn btn-primary" value="Submit"></a> 
                    </center>
      </td>
       
</form>
</html>
<?php
//echo "<tr>" ;                       
//echo "</tr>";
}                     
}
echo "</tbody>";
echo "</table>";                            
        // Free result set
mysqli_free_result($result);
mysqli_close($link);
}

?>
            </div>        
        </div>
    </div>
</div>   
</body>
</html>