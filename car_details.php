<?php 
$servername = "localhost";
$username = "";
$password = "";
$dbname = "test";
// Create connection
$link = new mysqli($servername, $username, $password, $dbname);
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$manu_fac_name = "select distinct manufacture_name from mini_car_store order by manufacture_name asc;";
?>
<link rel="stylesheet" href="style.css">
<center class='content'>
<h2>Enter all Car details in the below section</h2>
<form enctype="multipart/form-data" method="post">

	<input name="model" type="text"  placeholder="Model" />
	<select name='manufac_name' > <option  value='select'>Select manufacture</option>
		<?php 
		if ($result=mysqli_query($link,$manu_fac_name))
		{
		  // Fetch one and one row
		  while ($row=mysqli_fetch_row($result))
			{echo "<option value='$row[0]' >".ucfirst(strtolower($row[0]))."</option>";}
		  // Free result set
		  mysqli_free_result($result);

		}
		?>
	</select><br><br>
	<input name="color" type="text"  placeholder="Color" />
	<input name="manufac_year" type="text" onkeypress='validate(event)' placeholder="Manufacturing Year-YYYY" />
	<input name="price"  type="text" onkeypress='validate(event)' placeholder="Price" />
	<input name="regist_state" class='registry' type="text" maxlength="4" placeholder="4 digit code 'AB12'" />
	<input name="regist_code"  class='registry' type="text" maxlength="6" placeholder="AB1234" />
	
	<input name="submit" id='car_details_submit' type="submit" value="Submit" />
<a href='view_inventory.php' class='page_nav'>View all cars</a>
</form>

</center>
<?php
if (isset($_POST['submit']))
{
$model=strtoupper($_POST['model']);
$manufac_year=$_POST['manufac_year'];
$regist_number=strtoupper($_POST['regist_state']."-".$_POST['regist_code']);
$color=strtoupper($_POST['color']);
$price=$_POST['price'];
$manufac_name=strtoupper($_POST['manufac_name']);
//echo $model." ".$manufac_year." /".$regist_number."/ ".$color." /".$price."/ ".$manufac_name;
	if($manufac_name=='SELECT'){
		echo "<center><h3>Please select manufacture</h3></center>";
	}
	elseif($manufac_year=='' or $manufac_year=='' or  $regist_number=='-' or $color=='' or $price=='' or $manufac_name=='')
	{
		echo "<center><h3>Sorry!!! Please fill all the details.</h3></center>";
	}
	else{
		$car_dup_check="select manufacture_name from mini_car_store
						WHERE  registration_number='".$regist_number."';";
		if($results=mysqli_query($link,$car_dup_check)){
			$car = mysqli_fetch_row($results);
			if($car[0]!=''){
				echo "<center><h3>Registration Number already exists.</h3></center>";
				}
			else{
				$car_details ="INSERT INTO mini_car_store(manufacture_name,model,color,price,manufacturing_year,registration_number)
								VALUES('".$manufac_name."','".$model."','".$color."',".$price.",'".$manufac_year."','".$regist_number."');";
				$delete_duplicate="DELETE FROM mini_car_store where manufacture_name='".$manufac_name."' and model is null ;";
				if(mysqli_query($link,$car_details)){
					echo "<center><h3>Records Stored successfully.</h3></center>";
					mysqli_query($link,$delete_duplicate);
				}
				else{
					echo "<center><h3>Sorry!!! Could not able to store the records.</h3></center>";
				}
			}
		}
	}

$link->close(); 	
}?>
<script type="text/javascript" src="functions.js"></script>