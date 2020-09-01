<?php
$json_url = "https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-091?Authorization=CWB-6DBF737A-A676-4BC9-A35B-334E259FB4D2&locationName=" . $cityName;
$json = file_get_contents($json_url);
$links = json_decode($json, TRUE);

require_once("connect.php");

$deleteAll = "DELETE FROM oneWeek";
mysqli_query($link, $deleteAll);

$today = date('Y-m-d',strtotime('1 day'));

foreach($links['records']['locations'][0]['location'] as $key => $val){
    $locationName = $val['locationName'];

    foreach($val['weatherElement'][0]['time'] as $key2 => $val2){
        $time = $val2['startTime'];
        if($val2['startTime'] > $today){
            $popValue = $val2['elementValue'][0]['value'];
            if($val2['elementValue'][0]['value'] == " "){
                $popValue = "--";
            }

            $insertSql = <<<insertsql
            INSERT INTO oneWeek (locationName, startTime, rainP, wxName, wxValue, temp)
            VALUES ('$locationName', '$time', '$popValue', "", "", "");
            insertsql;
            mysqli_query($link, $insertSql);
        }
    }

    foreach($val['weatherElement'][1]['time'] as $key3 => $val3){
        $time = $val3['startTime'];
        if($val3['startTime'] > $today){
            $tempValue = $val3['elementValue'][0]['value'];
            if($val3['elementValue'][0]['value'] == " "){
                $tempValue = "--";
            }
            
            $updateTemp = <<<updatetemp
            UPDATE oneWeek SET temp = '$tempValue'
            WHERE locationName = '$locationName' AND startTime = '$time';
            updatetemp;
            mysqli_query($link, $updateTemp);
        }
    }

    foreach($val['weatherElement'][6]['time'] as $key4 => $val4){
        $time = $val4['startTime'];
        if($val4['startTime'] > $today){
            $wxName = $val4['elementValue'][0]['value'];
            $wxValue = $val4['elementValue'][1]['value'];
            if($val4['elementValue'][0]['value'] == " "){
                $wxName = "--";
            }
            if($val4['elementValue'][1]['value'] == " "){
                $wxValue = "--";
            }

            $updateWx = <<<updatewx
            UPDATE oneWeek SET wxName = '$wxName', wxValue = '$wxValue'
            WHERE locationName = '$locationName' AND startTime = '$time';
            updatewx;
            mysqli_query($link, $updateWx);
        }
    }
}

?>