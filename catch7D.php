<?php

$json_url = "https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-091?Authorization=CWB-6DBF737A-A676-4BC9-A35B-334E259FB4D2";
$json = file_get_contents($json_url);
$links = json_decode($json, TRUE);

$today = date('Y-m-d',strtotime('1 day'));

echo $links['records']['locations'][0]['locationsName'] . '<br>';

foreach($links['records']['locations'][0]['location'] as $key => $val){
    echo $val['locationName'] . '<br>';

    echo $val['weatherElement'][0]['elementName'] . '<br>';
    foreach($val['weatherElement'][0]['time'] as $key2 => $val2){
        $time = $val2['startTime'];
        if($val2['startTime'] > $today){
            $popValue = $val2['elementValue'][0]['value'];
            if($val2['elementValue'][0]['value'] == " "){
                $popValue = "--";
            }
            echo $time . '<br>';
            echo $popValue . '<br>';
        }
    }

    echo $val['weatherElement'][1]['elementName'] . '<br>';
    foreach($val['weatherElement'][1]['time'] as $key3 => $val3){
        $time = $val3['startTime'];
        if($val3['startTime'] > $today){
            $tempValue = $val3['elementValue'][0]['value'];
            if($val3['elementValue'][0]['value'] == " "){
                $tempValue = "--";
            }
            echo $time . '<br>';
            echo $tempValue . '<br>';
        }
    }

    echo $val['weatherElement'][6]['elementName'] . '<br>';
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
            echo $time . '<br>';
            echo $wxName . '<br>';
            echo $wxValue . '<br>';
        }
    }

    echo "<hr>";
}

?>