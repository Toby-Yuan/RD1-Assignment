<?php

require_once './models/database.php';

class updateRain extends database{

    public function __construct(){
        $this->update();
    }

    public function update(){
        $json_url = "https://opendata.cwb.gov.tw/api/v1/rest/datastore/O-A0002-001?Authorization=CWB-6DBF737A-A676-4BC9-A35B-334E259FB4D2&elementName=RAIN&elementName=HOUR_24&elementName=NOW";
        $json = file_get_contents($json_url);
        $links = json_decode($json, TRUE);

        foreach($links['records']['location'] as $key=>$val) {
            $locationName = $val['locationName'];
            $rain = $val['weatherElement'][0]['elementValue'];
            $hour24 = $val['weatherElement'][1]['elementValue'];
            $dayRain = $val['weatherElement'][2]['elementValue'];
        
            $search = self::query("SELECT locationName FROM town WHERE locationName = '$locationName'");
        
            if(isset($search[0]["locationName"])){
                $updateSql = <<<updatesql
                UPDATE rain SET rain = $rain, hour24 = $hour24, dayRain = $dayRain
                WHERE locationName = '$locationName';
                updatesql;
                $update = self::query($updateSql);
            }
        
        }
    }

}

?>