<?php
require_once ("dbcontroller.php");
$db_handle = new DBController();
if (! empty($_POST["cid"])) 
{
    $query = "SELECT cname FROM cpen WHERE cid = '" . $_POST["cid"] . "'";
    $results = $db_handle->runQuery($query);
    
?>
<option value disabled selected>Select Course</option>
<?php
    if (is_array($results) || is_object($results))
{
    foreach ($results as $result)
    {
        ?>
        <option value="<?php echo $result["cname"]; ?>"><?php echo $result["cname"]; ?></option>
<?php
}
        ?>

<?php
    }
}
?>
