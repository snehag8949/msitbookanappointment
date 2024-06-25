<?php

require_once ("dbcontroller.php");
$db_handle = new DBController();

if (! empty($_POST["specid"])) 
{
    $query = "SELECT * FROM courses WHERE specid = '" . $_POST["specid"] . "'";
    $results = $db_handle->runQuery($query);
    ?>
<option value disabled selected>Specialisation Name</option>
<?php
    foreach ($results as $specid) {
        ?>
<option value="<?php echo $specid["specn"]; ?>"><?php echo $specid["specn"]; ?></option>
<?php
    }
}

?>