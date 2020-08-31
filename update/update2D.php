<?php
$json_url = "https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-089?Authorization=CWB-6DBF737A-A676-4BC9-A35B-334E259FB4D2";
$json = file_get_contents($json_url);
$links = json_decode($json, TRUE);

require_once("connect.php");

$deleteAll = "DELETE FROM twoDay";
mysqli_query($link, $deleteAll);


foreach($links['records']['locations'][0]['location'] as $key => $val){
    $locationName = $val['locationName'];

    foreach($val['weatherElement'][0]['time'] as $key2 => $val2){
        $today = date('Y-m-d',strtotime('1 day'));

        if($val2['startTime'] > $today){
            $startTime = $val2['startTime'];
            $rainP = $val2['elementValue'][0]['value'];
            $startTime = $val2['startTime'];
    
            foreach($val['weatherElement'][1]['time'] as $key3 => $val3){
                if($val3['startTime'] == $startTime){
                    $wxName = $val3['elementValue'][0]['value'];
                    $wxValue = $val3['elementValue'][1]['value'];

                    $insertSql = <<< insertsql
                    INSERT INTO twoDay (locationName, startTime, rainP, wxName, wxValue, temp)
                    VALUES ('$locationName', '$startTime', $rainP, '$wxName', $wxValue, -99);
                    insertsql;
                    mysqli_query($link, $insertSql);
                }
            }
    
            foreach($val['weatherElement'][3]['time'] as $key4 => $val4){
                if($val4['dataTime'] == $startTime){
                    $temp = $val4['elementValue'][0]['value'];

                    $updateSql = <<<updqtesql
                    UPDATE twoDay SET temp = $temp WHERE locationName = '$locationName' AND startTime = '$startTime';
                    updqtesql;
                    mysqli_query($link, $updateSql);
                }
            }
        }

    }
}
?>