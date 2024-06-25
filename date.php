<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>LOA</title>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
<br>
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

    <!-- Dropdown -->
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
        Practicumm
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="sbook.php">Book</a>
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
                        <h2 class="pull-left"><i>List of Appointments</i></h2>                        
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    ?>
             <html>
                    <form class="form-group">
                      
                    <div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
                            <label>Date :</label>
                            <input type="date" name="date" class="form-control">                            
                    </div>
                    <center><button class="btn btn-primary">Submit</button></center>
                    <br>
                    <br>
     
                    <?php 
                  
                    $date = trim($_GET["date"]);
                    
                    $sql = "select time from sbook where date like '%$date' ORDER BY teamno ASC";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Time</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";                              
                                        
                                        echo "<td>" . $row['time'] . "</td>";
                                        
                                    $b=array($row['time']);
                                    
                                }
                                     $timings=array('9:30 AM to 10:45 AM','10:45 AM to 11:15 AM','11:15 AM to  12:00 Noon','3:00 PM to 3:30 PM','3:30 PM to 4:15 PM','4:15 PM to 5:15 PM');
                    $n=count($timings);
                    for($x=0;$x<$n;$x++){
                                          echo $b[$x];
                                         echo "//////////////////////";
                  if($b!=$timings[$x]){
                      
                     
                         print $timings[$x];
                     }
                  }
                                
                        }
                    
                    
                
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                        
                                  
                        
                        
                        
                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        
                         
                        
                     
                    // Close connection
                    mysqli_close($link);
                       
                    ?>
                    <br>
                    <center>
                    <a href="mentordashboard.html">  <input type="button" name="Submit" value="Dashboard"></a> 
                    </center>
                            </form>
                    </html> 
                </div>
            </div>        
        </div>
    </div>
          
</body>
</html>