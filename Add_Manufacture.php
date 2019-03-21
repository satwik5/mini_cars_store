<link rel="stylesheet" href="style.css">
<center class='content'>
	<h2> Insert Manufacture Name</h2>
	<form enctype="multipart/form-data" method="post">
		<label><b>Manufacture Name :</b></label>
		<input id='manufac_name' name="man_name" type="text"  placeholder="Manufacture Name" /><br>
		<input id='manufac_submit' name="submit" type="submit" value="Submit" />
	</form>
	<a href='car_details.php' class='page_nav'>Fill Car Details</a>
</center>

<?php 
if (isset($_POST['submit']))
{
	if($_POST['man_name']==''){
		echo "<center><h3>Please enter some value.</h3></center>";
		exit;
	}
$servername = "localhost";
$username = "";
$password = "";
$dbname = "test";
// Create connection
$link = new mysqli($servername, $username, $password, $dbname);
$manu_name=strtoupper($_POST['man_name']);
// Check connection
$man_names="select manufacture_name from mini_car_store where manufacture_name = '".$manu_name."';";
if($result=mysqli_query($link,$man_names)){
	$row=mysqli_fetch_row($result);
	if($row[0]==$manu_name){
		echo "<center><h3>Sorry ".ucfirst($manu_name)." already exists</h3></center>";
	}
	else{
		$sql = "insert into mini_car_store values('$manu_name','','','','','')";
		mysqli_query($link, $sql);
		echo "<center><h3>Records Stored successfully.</h3></center>";
	}
} 

$link->close(); 
}
?>
