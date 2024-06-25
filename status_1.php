<!DOCTYPE html>
<html lang="en">
<head>
  <title>Status</title>
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
    <h2><i>Status of the Applicants</i></h2>

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
       <!-- <a class="dropdown-item" href="mr.php">Register</a> -->
        <a class="dropdown-item" href="ml.php">Login</a>
        </div>
    </li>

    <!-- Dropdown 
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Students
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="createsr.php">Register</a>
        <a class="dropdown-item" href="createsl.php">Login</a>
    </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Appointment
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="sbook2.php">Book</a>
        </div>
    </li>-->
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
<div> <button class="btn btn-success" type="submit"><a href="index2.html">LogOut</a></button>
</div>                
<!--Profile dropdown-->

</nav>
</ul>
</div>
</nav>
<!--Nav bar-->
<!---Main frame--->
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Status of the Applicants</h2>
                      
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
                                        echo "<td>" . $row['status']."</td>";
$teamno = $row['teamno'];
                                }
                                 
                        
if(isset($_POST['Accepted'])) {
// update user in that row to level 1 in database
$st = $link->prepare("UPDATE sbook SET status = 'Accepted' WHERE teamno = '$teamno'");
$st->execute();

// print success message and redirect
print '<p class="success"> Team'     .$teamno.      ' Appointment has been updated to Accepted</p>';
//header('refresh:10;url=mentordashboard.html');

}
                                
//$teamno = $row['teamno'];
// if user hits Change to level 2 button;
if(isset($_POST['Denied'])) {

// set $username var


// update user in that row to level 2 in database
$s = $link->prepare("UPDATE sbook SET status = 'Denied' WHERE teamno = $teamno");
$s->execute();

// echo success message and redirect
print '<p class="success"> Team '   .$teamno.      'Appointment has been updated to Denied</p>';
//header('refresh:10;url=mentordashboard.html');

}
if(isset($_POST['Reschedule'])) {

// set $username var


// update user in that row to level 2 in database
$s = $link->prepare("UPDATE sbook SET status = 'Reschedule' WHERE teamno = $teamno");
$s->execute();

// echo success message and redirect
print '<p class="success"> Team '   .$teamno.      'Appointment has been updated to Reschedule</p>';
//header('refresh:10;url=mentordashboard.html');

}

                            
?>                        
   <html>                                 
   
    <td class="table_content">
    <form method="post" class="table_content_form">
      <button class="btn btn-default" type="submit" name="Accepted">Accepted</button>
      <input type="hidden" name="teamno" value="' .$row['teamno']. '"/>
      <input type="hidden" name="status" value='Accepted'/>
    </form>
    </td>

    <td class="table_content">
    <form method="post" class="table_content_form">
      <button class="btn btn-default" type="submit" name="Denied">Denied</button>
      <input type="hidden" name="teamno" value="' .$row['teamno']. '"/>
      <input type="hidden" name="status" value='Denied'/>
    </form>
    </td>
       
       
<td class="table_content">
    <form method="post" class="table_content_form">
      <button class="btn btn-default" type="submit" name="Reschedule">Reschedule</button>
      <input type="hidden" name="teamno" value="' .$row['teamno']. '"/>
      <input type="hidden" name="status" value='Reschedule'/>
    </form>
    </td>
   </html>                                   
<?php  
                        
                               echo "</tr>";
                                     //echo "<tr>" ;
                                    //echo "</tr>";                    
                                echo "</tbody>";                            
                            echo "</table>";
                        }
                            // Free result set
                            mysqli_free_result($result);
                    
                    }
                        // Close connection
                    mysqli_close($link);
                    
                 
    ?>
</div>        
</div>
</div>
</div>   
</body>
</html>