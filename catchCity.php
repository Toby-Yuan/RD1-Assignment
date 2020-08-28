<?php
exit();
$json_url = "https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-C0032-001?Authorization=CWB-6DBF737A-A676-4BC9-A35B-334E259FB4D2";
$json = file_get_contents($json_url);
$links = json_decode($json, TRUE);

require_once("connect.php");

foreach($links['records']['location'] as $key=>$val){
    $locationName = $val['locationName'];
    $wxName = $val['weatherElement'][0]['time'][0]['parameter']['parameterName'];
    $wxValue = $val['weatherElement'][0]['time'][0]['parameter']['parameterValue'];
    $popValue = $val['weatherElement'][1]['time'][0]['parameter']['parameterName'];

    $insertSql = <<<insertsql
    INSERT INTO city36hr (locationName, wxName, wxValue, popValue)
    VALUES ('$locationName', '$wxName', $wxValue, $popValue);
    insertsql;
    mysqli_query($link, $insertSql);
}
?>