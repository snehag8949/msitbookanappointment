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
    echo "Connected successfully";
    echo " ";
}

// Define variables and initialize with empty values
$teamno = $ptitle = $date  = $time = "";
$teamno_err = $ptitle_err = $date_err  = $time_err =  "";
 
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
    
    
    
    
    
    
    
    
    
    
    
    
    // Check input errors before inserting in database
    if(empty($teamno_err) && empty($ptitle_err) && empty($date_err) && empty($time_err) ){
        // Prepare an insert statement
        $sql = "INSERT INTO sbook (teamno , ptitle , date ,time) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isss", $param_teamno,$param_ptitle,$param_date,$param_time);
            
            // Set parameters
            $param_teamno   = $teamno;
            $param_ptitle   = $ptitle;
            $param_date     = $date;
            $param_time    = $time;
            
            
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
<link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <title>Book an appointment</title>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.1/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.1/css/bootstrap-datepicker.min.css"/>

   <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Book</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                       <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Team number</label><span style="color: red !important; display: inline; float: none;">*</span>      
                            <input type="number" name="teamno" class="form-control" value="<?php echo $teamno; ?>">
                            <span class="help-block"><?php echo $teamno_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Project Title</label><span style="color: red !important; display: inline; float: none;">*</span>      
                            <input type="text" name="ptitle" class="form-control" value="<?php echo $ptitle; ?>">
                            <span class="help-block"><?php echo $ptitle_err;?></span>
                        </div>

                    <div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
                             <label for="datepicker1">Date</label><span style="color: red !important; display: inline; float: none;">*</span>      
                            <input type="date" name="date" class="form-control" id="datepicker1" value="<?php echo $date; ?>">
                            <span class="help-block"><?php echo $date_err;?></span>
                        </div>
                     
                        <div class="form-group <?php echo (!empty($time_err)) ? 'has-error' : ''; ?>">
                            <label>Time</label>
                            <label for="time">Time</label><span style="color: red !important; display: inline; float: none;">*</span>
                            
                
                            
                            <input list="hosting-plan" class="form-control" type="text" />
                            <datalist id="hosting-plan">
    <option value="9:30am-10:15am">9:30am-10:15am</option>
                            <option selected="true" disabled="disabled" value="10:15am-10:45am">10:15am-10:45am</option>
                             <option value="10:45am-11:15am">10:45am-11:15am</option>
                             <option value="11:15am-12Noon">11:15am-12Noon</option>
                            <option value="3:00pm-3:30pm">3:00pm-3:30pm</option>
                             <option value="3:30pm-4:15pm">3:30pm-4:15pm</option>
                             <option value="4:15pm-5:15pm">4:15pm-5:15pm</option>
</datalist>
                            
                        
                            
                            <span class="help-block"><?php echo $time_err;?></span></div>       
                        
                        <br>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index2.html" class="btn btn-default">Cancel</a>
                        <a href="update.php" class="btn btn-primary">Update</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>