<?php
$json_url = "https://opendata.cwb.gov.tw/api/v1/rest/datastore/O-A0002-001?Authorization=CWB-6DBF737A-A676-4BC9-A35B-334E259FB4D2&elementName=RAIN&elementName=HOUR_24&elementName=NOW";
$json = file_get_contents($json_url);
$links = json_decode($json, TRUE);

require_once("connect.php");

foreach($links['records']['location'] as $key=>$val) {
    $locationName = $val['locationName'];
    $rain = $val['weatherElement'][0]['elementValue'];
    $hour24 = $val['weatherElement'][1]['elementValue'];
    $dayRain = $val['weatherElement'][2]['elementValue'];

    $search = "SELECT locationName FROM town WHERE locationName = '$locationName'";
    $result = mysqli_query($link, $search);
    $row = mysqli_fetch_assoc($result);

    if(isset($row["locationName"])){
        $updateSql = <<<updatesql
        UPDATE rain SET rain = $rain, hour24 = $hour24, dayRain = $dayRain
        WHERE locationName = '$locationName';
        updatesql;
        mysqli_query($link, $updateSql);
    }

}
?>