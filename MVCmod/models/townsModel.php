<?php

require_once './models/database.php';
require_once './models/updateCityTown.php';

class townsM extends database{
    public $cityTown;

    public function __construct(){
        if(!isset($_GET['city'])){
            header("location: ./hello");
            exit();
        }

        $this->cityTown = new updateCT();
    }

    public function getTown(){
        $city = $_GET['city'];
        $citycode = self::query("SELECT code FROM city36hr WHERE locationName='$city'");
        $update = $this->cityTown->update($citycode[0]['code']);
        return $city . $citycode[0]['code'];
    }

    public function get(){
        $city = $_GET['city'];
        $search = self::query("SELECT locationName FROM cityTown GROUP BY locationName");
        return $search;
    }

    public function catch($city){
        $search = self::query("SELECT * FROM cityTown WHERE locationName = '$city'");
        return $search;
    }

}

?>