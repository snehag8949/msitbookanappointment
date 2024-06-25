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
    echo ".";
    echo " ";
}
session_start();
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
    
    // $result = mysqli_query($conn, $sql);

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
   
    
     <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>  

    
  <title>Book an appointment</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
            
            
           p.pfield-wrapper input {
  float: right;
}
p.pfield-wrapper::after {
  content: "\00a0\00a0 "; /* keeps spacing consistent */
  float: right;
}
p.required-field::after {
  content: "*";
  float: center;
  margin-left: -3%;
  color: red;
}   
        
    </style>
    </head>
<body>
 <div id="time"></div>
   <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-06">
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
                            <input type="text" name="date" class="form-control" id="datepicker1" value="<?php echo $date; ?>">
                            <span class="help-block"><?php echo $date_err;?></span>
                    </div>
                        
                        
                        
                       <select name="time" class="form-control">
                            <option value="9:30am-10:15am">9:30am-10:15am</option>
                            <option value="10:15am-10:45am">10:15am-10:45am</option>
                             <option value="10:45am-11:15am">10:45am-11:15am</option>
                             <option value="11:15am-12Noon">11:15am-12Noon</option>
                            <option value="3:00pm-3:30pm">3:00pm-3:30pm</option>
                             <option value="3:30pm-4:15pm">3:30pm-4:15pm</option>
                             <option value="4:15pm-5:15pm">4:15pm-5:15pm</option>

                        </select> 
                        
                        
                        <!--<br>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index2.html" class="btn btn-default">Cancel</a>
                        <a href="update.php" class="btn btn-primary">Update</a>-->
                   
                
         
                    
                    </form>
                </div>
            </div>
       </div>
    </div>
    
</body>
</html>
