
<html>
<head>
    <meta charset="UTF-8">
    <title>Status</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
</head>
<body>
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
                                        print "<td>" . $row['teamno'] . "</td>";
                                        print "<td>" . $row['ptitle'] . "</td>";
                                        print "<td>" . $row['date'] . "</td>";
                                        print "<td>" . $row['time'] . "</td>";
                                        print "<td>" . $row['status']."</td>";
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
   </html>                                   
<?php                                                          
  
                                     echo "<tr>" ;
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
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