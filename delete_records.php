<?php 
if(isset($_GET['str']) && !empty($_GET['str']))
{
$str = $_GET['str'];
$servername = "localhost";
$username = "";
$password = "";
$dbname = "test";
$link = new mysqli($servername, $username, $password, $dbname);
	$string=explode(" ",$str);
    $update = "DELETE FROM mini_car_store WHERE manufacture_name='".$string[0]."' and model='".$string[1]."' and color='".$string[2]."' and manufacturing_year='".$string[3]."' and registration_number='".$string[4]."';";
	$restore_manufac_name="INSERT INTO mini_car_store(manufacture_name) VALUES('".$string[0]."')";
    if (mysqli_query($link,$update) and mysqli_query($link,$restore_manufac_name))
    {
        echo "Selected car deleted successfully";
    } 
    else 
    {
        echo "Error updating record: " . mysqli_error($link);
    }
    die;
}
$link->close(); 
?>