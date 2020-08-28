<?php
$json_url = "https://opendata.cwb.gov.tw/api/v1/rest/datastore/O-A0003-001?Authorization=CWB-6DBF737A-A676-4BC9-A35B-334E259FB4D2";
$json = file_get_contents($json_url);
$links = json_decode($json, TRUE);

require_once("connect.php");

foreach($links['records']['location'] as $key=>$val){
    $locationName = $val['locationName'];
    $stationId = $val['stationId'];
    $cityName = $val['parameter'][0]['parameterValue'];
    $townName = $val['parameter'][2]['parameterValue'];
    $temp = $val['weatherElement'][3]['elementValue'];
    $dtx = $val['weatherElement'][14]['elementValue'];
    $dtn = $val['weatherElement'][16]['elementValue'];

    $insertSql = <<<insertsql
    INSERT INTO town (locationName, stationId, cityName, townName, temp, D_tx, D_tn)
    VALUES ('$locationName', $stationId, '$cityName', '$townName', $temp, $dtx, $dtn);
    insertsql;
    mysqli_query($link, $insertSql);
}
?>