 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
    
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">List</h2>
                    </div>
    <?php 
    
    require_once "config.php";
    //Initialise variables
    $teamno = $ptitle = $time = $date = "";
    $teamno_err = $ptitle_err = $time_err =$date_err = "";
    //Getting date from html page
    if(isset($_GET["date"]) && !empty(trim($_GET["date"]))){
        // Get URL parameter
        $date =  trim($_GET["date"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM sbook WHERE date = ?";
      if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_date);
            
            // Set parameters
            $param_date = $date;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
       
            if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Team number</th>";
                                        echo "<th>Project Title</th>";
                                        echo "<th>Time</th>";
                                        echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['teamno'] . "</td>";
                                        echo "<td>" . $row['ptitle'] . "</td>";
                                        echo "<td>" . $row['time'] . "</td>";
                                        echo "<td>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        }else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
            }
      }
                // Close connection
       mysqli_close($link);
    }
         
      

    
?>

                </div>
                </div>
            </div>
        </div>
    </body>
</html>