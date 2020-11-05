<?php
$hostname = "vmo1.co.uk";
$username = "vmo1co_sam";
$password = "gambling911";
$dbname = "vmo1co_co";	
	//CONNECTION OBJECT
	//This Keeps the Connection to the Databade
	$conn = new MySQLi($hostname, $username, $password, $dbname) or die('Can not connect to database')		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>
<body>

<?php
	if(isset($_POST['Submit'])){//if the submit button is clicked
	
	
	
	$Website_Name = $_POST['Website_Name'];
	
	$update = "UPDATE Websites SET Website_Name='$Website_Name' WHERE id = 1";

	$conn->query($update) or die("Cannot update");//update or error

	}
?>

<?php

//Create a query
$sql = "SELECT * FROM Websites WHERE id = 1";

//submit the query and capture the result
$result = $conn->query($sql) or die(mysql_error());

$query=getenv(QUERY_STRING);
parse_str($query);


//$ud_title = $_POST['Title'];
//$ud_pub = $_POST['Publisher'];
//$ud_pubdate = $_POST['PublishDate'];
//$ud_img = $_POST['Image'];

?>
<h2>Update Record <?php echo $bookid;?></h2>

<form action="" method="post">
<?php
	
	
	while ($row = $result->fetch_assoc()) {?>
    
<table border="0" cellspacing="10">
<tr>
<td>Title:</td> <td><input type="text" name="Website_Name" value="<?php echo $row['Website_Name']; ?>"></td>
</tr>

<tr>
<td><INPUT TYPE="Submit" VALUE="Update the Record" NAME="Submit"></td>
</tr>
</table>
<?php	}
	?>
</form>





<?php
	if($update){//if the update worked
	
	echo "<b>Update successful!</b>";
	
	
		
}  

?>

</body>
</html>