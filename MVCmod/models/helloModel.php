<?php

require_once './models/database.php';
require_once './models/updateRain.php';
require_once './models/updateTwo.php';
require_once './models/updateWeek.php';

class helloM extends database{

    public function allCityList(){
        $search = self::query("SELECT locationName FROM city36hr");
        return $search;
    }

    public function allTownList($city){
        $search = self::query("SELECT locationName, townName FROM town WHERE cityName = '$city'");
        return $search;
    }

    public function getCity(){
        if(isset($_POST['submit'])){
            $updateR = new updateRain();
            $city = $_POST['city'];
            $town = $_POST['town'];
            $searchIt = <<<searchit
            SELECT c.locationName city, t.locationName town, wxName, wxValue, popValue, image,
            temp, D_tn, D_tx, rain, hour24, dayRain
            FROM city36hr c
            JOIN town t ON t.cityName = c.locationName
            JOIN rain r ON r.locationName = t.locationName
            WHERE c.locationName = '$city' AND t.locationName = '$town'
            searchit;

            $search = self::query($searchIt);
            return $search;
        }
    }

    public function getTwo(){
        $city = $_POST['city'];
        $update2 = new updateTwo();
        $update = $update2->update($city);
        $search = self::query("SELECT * FROM twoDay WHERE locationName = '$city'");
        return $search;
    }

    public function getWeek(){
        $city = $_POST['city'];
        $update7 = new updateWeek();
        $update = $update7->update($city);
        $search = self::query("SELECT * FROM oneWeek WHERE locationName = '$city'");
        return $search;
    }

}

?>