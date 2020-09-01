  
<?php
$result = "";
if (!isset($_GET["letter"])) {
	die("no letter found.");
}
$letter = $_GET["letter"];

require_once("connect.php");
require_once("update/updateTown.php");

$searchTown = "SELECT locationName, townName FROM town WHERE cityName = '$letter'";
$resultTown = mysqli_query($link, $searchTown);

while($town = mysqli_fetch_assoc($resultTown)){
    $townLocation = $town['townName'] . "/" . $town['locationName'];
    $location = $town['locationName'];
    $result .= sprintf("<option value='%s'>%s</option>", $location, $townLocation);
}

echo $result;
?>