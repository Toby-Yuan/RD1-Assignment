<?php

require_once './models/database.php';

class updateCT extends database{

    public function __construct(){
        $deleteAll = self::query("DELETE FROM cityTown");
    }

    public function update($value){
        $json_url = "https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-" . $value . "?Authorization=CWB-6DBF737A-A676-4BC9-A35B-334E259FB4D2&elementName=PoP12h&elementName=Wx&elementName=T";
        $json = file_get_contents($json_url);
        $links = json_decode($json, TRUE);

        foreach($links['records']['locations'][0]['location'] as $key => $val){
            $locationName = $val['locationName'];
        
            foreach($val['weatherElement'][0]['time'] as $key2 => $val2){
                $today = date('Y-m-d',strtotime('1 day'));
        
                if($val2['startTime'] > $today){
                    $startTime = $val2['startTime'];
                    $rainP = $val2['elementValue'][0]['value'];
                    $startTime = $val2['startTime'];
            
                    foreach($val['weatherElement'][1]['time'] as $key3 => $val3){
                        if($count < 2){
                            if($val3['startTime'] == $startTime){
                                $wxName = $val3['elementValue'][0]['value'];
                                $wxValue = $val3['elementValue'][1]['value'];
            
                                $insertSql = <<< insertsql
                                INSERT INTO cityTown (locationName, startTime, popValue, wxName, wxValue, temp)
                                VALUES ('$locationName', '$startTime', $rainP, '$wxName', $wxValue, -99);
                                insertsql;
                                $insert = self::query($insertSql);
                            }
                        }
                    }
        
                    foreach($val['weatherElement'][2]['time'] as $key4 => $val4){
                        if($count2 < 2){
                            if($val4['dataTime'] == $startTime){
                                $temp = $val4['elementValue'][0]['value'];
            
                                $updateSql = <<<updqtesql
                                UPDATE cityTown SET temp = $temp WHERE locationName = '$locationName' AND startTime = '$startTime';
                                updqtesql;
                                $update = self::query($updateSql);
                            }
                        }
                    }
                }
            }
        
        }
    }

}

?>