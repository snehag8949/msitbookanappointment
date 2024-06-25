


<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$P_name = $P_id = $Teamno = $Status = "";
$P_name_err = $P_id_err = $Teamno_err = $Status_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $P_name_err = "Please enter your Project name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $P_name_err = "Please enter a valid name.";
    } else{
        $P_name = $input_name;
    }
    
    // Validate Project-id
    $input_id = trim($_POST["id"]);
    if(empty($input_id)){
        $P_id_err = "Please enter Project-id.";     
    }else{
        $P_id = $input_id;
    }
    
    //Validate Teamno
   $input_team = trim($_POST["Teamno"]);
    if(empty($input_team)){
        $Teamno_err = "Please enter Team number.";     
    } else{
        $Teamno = $input_team;
    }
    
    
    //Validate Status Accepted or Denied(Varchar)
    
   
    $input_Status = trim($_POST["Status"]);
    if(empty($input_Status)){
        $Status_err = "Enter whether the project is accepted or denied";
    } elseif(!filter_var($input_Status, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $Status_err = "Please enter a valid approval.";
    } else{
        $Status = $input_Status;
    }
        
    
   /* //Validate Status
    $input_s = trim($_POST["Status"]);
    if(empty($input_s)){
        $Status_err = "Please enter 2 for Accepted and 1 for Denial.";     
    } else{
        $Status = $input_s;
    }*/
    
    // Check input errors before inserting in database
    if(empty($P_name_err) && empty($P_id_err) && empty($Teamno_err) && empty($Status_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO cn (specs,cname1,cname2,cname3,cname4,cname5) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_name, $param_id,$param_Teamno, $param_Status);
            
            // Set parameters
            $param_name     = $P_name;
            $param_id       = $P_id;
            $param_Teamno   = $Teamno;
            $param_Status   = $Status;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: landing.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
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
    <title>Create Record</title>
    <link rel="stylesheet" href="create.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="bg">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Add Course</h2>
                    </div>
                    <p>Please fill this form and submit to add new course.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($P_name_err)) ? 'has-error' : ''; ?>">
                            <label>Project Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $P_name; ?>">
                            <span class="help-block"><?php echo $P_name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($P_id_err)) ? 'has-error' : ''; ?>">
                            <label>Project-Id</label>
                            <textarea name="id" class="form-control"><?php echo $P_id; ?></textarea>
                            <span class="help-block"><?php echo $P_id_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Teamno_err)) ? 'has-error' : ''; ?>">
                            <label>Team number</label>
                            <input type="text" name="Teamno" class="form-control" value="<?php echo $Teamno; ?>">
                            <span class="help-block"><?php echo $Teamno_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Status_err)) ? 'has-error' : ''; ?>">
                            <label>Status</label>
                            <input type="text" name="Status" class="form-control" value="<?php echo $Status; ?>">
                            <span class="help-block"><?php echo $Status_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="landing.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>