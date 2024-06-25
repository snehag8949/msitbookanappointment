<?php
// Include config file
//require_once "config.php";
 $link = mysqli_connect("localhost","root","root","project");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
else
{
    echo "Connected";
    
}
require_once("dbcontroller.php");
$db_handle = new DBController();
$query ="SELECT * FROM courses";
$results = $db_handle->runQuery($query);
session_start();

// Define variables and initialize with empty values
$teamno = $ptitle = $date  = $time = $status = $id = $specid = $comments = "";
$teamno_err = $ptitle_err = $date_err  = $time_err = $status_err = $id_err = $specid_err  = $comments_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
   $input_teamno = trim($_POST["teamno"]);
    if(empty($input_teamno)){
        $teamno_err = "Please enter your team no.";
    }  else{
        $teamno = $input_teamno;
    } 

    //Validate password
    $input_ptitle = trim($_POST["ptitle"]);
    if(empty($input_ptitle)){
        $ptitle_err = "Please enter your project title.";
    } elseif(!filter_var($input_ptitle, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $ptitle_err = "Please enter a valid project title.";
    } else{
        $ptitle = $input_ptitle;
    }
    
    $input_date = trim($_POST["date"]);
    if(empty($input_date)){
        $date_err = "Please enter your date.";
    }  else{
        $date = $input_date;
    } 
    
    $input_time = trim($_POST["time"]);
    if(empty($input_time)){
        $time_err = "Please enter time.";
    }  else{
        $time = $input_time;
    }
    
    
    //Validate Roll number
    $input_id = trim($_POST["id"]);
    if(empty($input_id)){
        $id_err = "Please enter your Roll number.";
    }  else{
        $id = $input_id;
    } 
    
    //Validate course-id
    $input_specid = trim($_POST["specid"]);
    if(empty($input_specid)){
        $specid_err = "Please enter Specialisation-Id";
    }  else{
        $specid = $input_specid;
    } 
    
    
    // Check input errors before inserting in database
    if(empty($teamno_err) && empty($ptitle_err) && empty($date_err) && empty($time_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO sbook (teamno ,specid, ptitle, date ,time) VALUES (?, ?, ?, ?, ?) ";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "iisss", $param_teamno,$param_ptitle,$param_date,$param_time);
            
            // Set parameters
            $param_teamno   = $teamno;
            $param_specid   = $specid;
            $param_ptitle   = $ptitle;
            $param_date     = $date;
            $param_time     = $time;
                  
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to response page
                header("location: response.html");
                exit();
            } else{
                echo "Team number has already been saved.";
            }
        }
         
        // Close statement
    //    mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<title>Bookings</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
    $(function() {
  var $dp1 = $("#datepicker1");
  $dp1.datepicker({
    changeYear: true,
    changeMonth: true,
    minDate: 0,
    dateFormat: "yy-m-dd",
    yearRange: "-100:+20",
  });

  var $dp2 = $("#datepicker2");
  $dp2.datepicker({
    changeYear: true,
    changeMonth: true,
    yearRange: "-100:+20",
    dateFormat: "yy-m-dd",
  });
});
    </script> 
   <script>
function getState(val) {
	$.ajax({
	type: "POST",
	url: "getState.php",
	data:'specid='+val,
	success: function(data){
		$("#state-list").html(data);
		getCity();
	}
	});
}
function getCity(val) {
	$.ajax({
	type: "POST",
	url: "getCity.php",
	data:'specid='+val,
	success: function(data){
		$("#city-list").html(data);
	}
	});
}

</script>    
    
     <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>  
    <style>
    div
        {
            margin:20px;
        }   
    .frmDronpDown {
    border: 1px solid #7ddaff;
    background-color: #C8EEFD;
    margin: 2px 0px;
    padding: 40px;
    border-radius: 4px;
}

.demoInputBox {
    padding: 10px;
    border: #bdbdbd 1px solid;
    border-radius: 4px;
    background-color: #FFF;
    width: 50%;
}

.row {
    padding-bottom: 15px;
}
</style> 
 </head>
<body>
<center><h1><i>Book an Appointment</i></h1></center>
    
<br>
    <h2><i></i></h2>

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
        Students
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="createsr.php">Register</a>
        <a class="dropdown-item" href="createsl.php">Login</a>
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
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="page-header">
                        <!--<h2>Book</h2>-->
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                       
              <!--Country----Specialisation Id
                State-------Specname
                City-------Cname--->
                        <div class="form-group <?php echo (!empty($teamno_err)) ? 'has-error' : ''; ?>">
                            <label>Team number</label><span style="color: red !important; display: inline; float: none;">*</span>      
                            <input type="number" name="teamno" class="form-control" value="<?php echo $teamno; ?>">
                            <span class="help-block"><?php echo $teamno_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($specid_err)) ? 'has-error' : ''; ?>">
                            <label>Specialisation Id</label><span style="color: red !important; display: inline; float: none;">*</span>      
                            <input type="number" name="specid" class="form-control" value="<?php echo $specid; ?>">
                            <span class="help-block"><?php echo $specid_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($ptitle_err)) ? 'has-error' : ''; ?>">
                            <label>Project Title</label><span style="color: red !important; display: inline; float: none;">*</span>      
                            <input type="number" name="ptitle" class="form-control" value="<?php echo $ptitle; ?>">
                            <span class="help-block"><?php echo $ptitle_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
                             <label for="datepicker1">Date</label><span style="color: red !important; display: inline; float: none;">*</span>      
                            <input type="text" name="date" class="form-control" id="datepicker1" value="<?php echo $date; ?>">
                            <span class="help-block"><?php echo $date_err;?></span>
                    </div>
                        
                         <div class="form-group <?php echo (!empty($time_err)) ? 'has-error' : ''; ?>">
                            <label>Time</label>
                            <label for="time"></label><span style="color: red !important; display: inline; float: none;">*</span>
                <select name="time" class="form-control">
                            <option value="">None</option>
                            <option value="9:30am-10:15am">9:30am-10:15am</option>
                            <option value="10:15am-10:45am">10:15am-10:45am</option>
                            <option value="10:45am-11:15am">10:45am-11:15am</option>
                            <option value="11:15am-12Noon">11:15am-12Noon</option>
                            <option value="3:00pm-3:30pm">3:00pm-3:30pm</option>
                            <option value="3:30pm-4:15pm">3:30pm-4:15pm</option>
                            <option value="4:15pm-5:15pm">4:15pm-5:15pm</option>

                </select>
            </div>
                
                        <div class="form-group <?php echo (!empty($id_err)) ? 'has-error' : ''; ?>">
                            <label>Roll number</label><span style="color: red !important; display: inline; float: none;">*</span>      
                            <input type="text" name="id" class="form-control" value="<?php echo $id; ?>">
                            <span class="help-block"><?php echo $id_err;?></span>
                        </div>
                    
                        <br>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="studentdashboard.html" class="btn btn-default">Cancel</a>
                        <a href="update.php" class="btn btn-primary">Update</a>                      
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
$query = "SELECT * FROM courses WHERE specid = '" . $_POST["specid"] . "'";