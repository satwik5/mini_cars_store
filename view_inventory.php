
<link rel="stylesheet" href="style.css">
<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"-->
<?php 
$servername = "localhost";
$username = "";
$password = "";
$dbname = "test";
// Create connection
$link = new mysqli($servername, $username, $password, $dbname);
$full_car_details=[];
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$total_details ='Select distinct manufacture_name, model  from mini_car_store where model<>"" order by manufacture_name;';
$car_count=0;
$series=1;
$count=0;
?>
<div class="container">
<center><h2>Details of all models </h2>
    <table class="table table-border table-hover">
	<thead>
	
        <tr>
			<th>Series</th>
			<th>Manufacture</th>
			<th>Model</th>
			<th>Count</th>
		</tr>
    </thead>
    <tbody id="tableId">
        <?php
if ($result=mysqli_query($link,$total_details))
{
  while ($row=mysqli_fetch_row($result))
	{
		echo "<tr>";
		echo "<td>$series</td>";
		echo "<td>$row[0]</td>";
		echo "<td>$row[1]</td>";
		$car_count = "Select count(1) from mini_car_store where manufacture_name='".$row[0]."' and model='".$row[1]."';";
		$total_cars ="Select manufacture_name, model,color,price,manufacturing_year,registration_number from mini_car_store where manufacture_name='".$row[0]."' and model='".$row[1]."';";
		if ($results = mysqli_query($link,$car_count) and $car_results = mysqli_query($link,$total_cars))
		{

		  while ($car = mysqli_fetch_row($results))
			{
				echo "<td>$car[0]</td>";
			}
				echo "</tr>";
		   while ($all_cars = mysqli_fetch_row($car_results))
			{
				$full_car_details[$count]= "$all_cars[0] $all_cars[1] $all_cars[2]  Rs.$all_cars[3]  $all_cars[4] $all_cars[5]";
				echo "<span class='fullCarDetails' hidden>".json_encode($full_car_details[$count])."</span>";
				$count++;
			}
		}
		
	$series++;

	}
$count=0;
$series=0;

  // Free result set
  mysqli_free_result($result);

}
?>
      </tbody>
    </table>
	</center>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
		<ul id="menu">
		  <li>Manufature</li>
		  <li>Model</li>
		  <li>Color</li>
		  <li>Price</li>
		  <li>Model-Year</li>
		  <li>Registration-number</li>
		</ul> 
	</div>
    <div class="modal-body"> 
    </div>
    <div class="modal-footer"><p></p></div>
	</div>
</div>


<script type="text/javascript" src="functions.js"></script>