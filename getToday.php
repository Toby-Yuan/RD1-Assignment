<?php

if(isset($_POST["submit"])){
    $cityName = $_POST["city"];
    $towmLocation = $_POST["town"];

    $searchCityImage = "SELECT image, wxValue, popValue, wxName FROM `city36hr` WHERE locationName = '$cityName'";
    $resultImage = mysqli_query($link, $searchCityImage);
    $image = mysqli_fetch_assoc($resultImage);

    $howsW = "";
    if($image["wxValue"] < 3){
        $howsW = "sun.png";
    }elseif($image["wxValue"] < 5){
        $howsW = "sunCloud.png";
    }elseif($image["wxValue"] < 8){
        $howsW = "cloud.png";
    }else{
        $howsW = "rain.png";
    }

    $rainP = $image["popValue"] . "%";

    $searchTown = <<<searchtown
    SELECT temp, D_tx, D_tn, rain, hour24, dayRain FROM town t
    JOIN rain r ON t.locationName = r.locationName
    WHERE t.locationName = '$towmLocation';
    searchtown;
    $resultTown = mysqli_query($link, $searchTown);
    $town = mysqli_fetch_assoc($resultTown);

    if($town["temp"] == -99){
        $town["temp"] = "--";
    }

    if($town["D_tx"] == -99){
        $town["D_tx"] = "--";
    }

    if($town["D_tn"] == -99){
        $town["D_tn"] = "--";
    }
    
    if($town["rain"] == -998){
        $town["rain"] = "--";
    }
}

?>