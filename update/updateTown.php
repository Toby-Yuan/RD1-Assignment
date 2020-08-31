<?php
$json_url = "https://opendata.cwb.gov.tw/api/v1/rest/datastore/O-A0003-001?Authorization=CWB-6DBF737A-A676-4BC9-A35B-334E259FB4D2";
$json = file_get_contents($json_url);
$links = json_decode($json, TRUE);

require_once('connect.php');

foreach($links['records']['location'] as $key=>$val){
    $locationName = $val['locationName'];
    $temp = $val['weatherElement'][3]['elementValue'];
    $dtx = $val['weatherElement'][14]['elementValue'];
    $dtn = $val['weatherElement'][16]['elementValue'];

    $updateSql = <<<updatesql
    UPDATE town SET temp = $temp, D_tx = $dtx, D_tn = $dtn
    WHERE locationName = '$locationName';
    updatesql;
    mysqli_query($link, $updateSql);
}
?>