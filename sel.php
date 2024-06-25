<?php  
$con=mysqli_connect ("localhost","root","root");  
mysqli_select_db("project",$con);  
@$a=$_POST['txt1'];  
@$b=$_POST['txt2'];  
@$c=$_POST['txt3'];  
@$d=$_POST['txt4'];  
if(@$_POST['inser'])  
{  
 $s="insert into employee values ('$a','$b','$c','$d')";  
echo "Your Data Inserted";  
 mysql_query ($s);  
}  
$con=mysql_connect ("localhost","root","");  
mysql_select_db ("mcn",$con);  
if(@$_POST ['sel'])  
{  
echo $ins=mysql_query ("select * from employee");  
echo "<table bgcolor=skyblue border='2'>  
   <tr>  
   <th colspan=4>Select Data From Employee Table</th></tr>  
   <tr>  
   <th>Nmae</th>  
   <th>Designation</th>  
   <th>Sal</th>  
   <th>Qualification</th>  
   </tr>";  
   while ($row=mysql_fetch_array ($ins))  
   {  
   echo "<tr>";  
   echo  "<th>".$row ['Name']."</th>";  
   echo  "<th>". $row ['Designation']. "</th>";  
   echo  "<th>". $row ['Sal']."</th>";  
   echo  "<th>".$row ['Qualification']."</th>";  
   echo "</tr>";  
   }  
   }  
   echo "</table>"  
?>  
<html>  
<head>  
</head>  
<body bgcolor="pink">  
<table bgcolor="skyblue" border="2">  
<form method="post">  
<tr>  
<td colspan=2 align="center">Employee Table</td>  
</tr>  
<td>Name</td><td><input type="text" name="txt1"></td>  
 
<tr>  
<td>Designation</td><td><input type="text" name="txt2"></td>  
</tr>  
<tr>  
<td>Sal</td><td><input type="text" name="txt3"></td>  
</tr>  
<tr>  
<td>Qualification</td><td><input type="text" name="txt4"></td>  
</tr>  
<tr>  
<td><input type="submit" name="inser" value="Insert"></td>  
<td><input type="submit" name="sel" value="Select"></td>  
</tr>  
</form>  
</table>  
</body>  
</html>  