<?php
$json_url = "https://opendata.cwb.gov.tw/api/v1/rest/datastore/O-A0002-001?Authorization=CWB-6DBF737A-A676-4BC9-A35B-334E259FB4D2";
$json = file_get_contents($json_url);
$links = json_decode($json, TRUE);

require_once("connect.php");

foreach($links['records']['location'] as $key=>$val) {
    $locationName = $val['locationName'];
    $rain = $val['weatherElement'][1]['elementValue'];
    $hour24 = $val['weatherElement'][6]['elementValue'];
    $dayRain = $val['weatherElement'][7]['elementValue'];

    $search = "SELECT locationName FROM town WHERE locationName = '$locationName'";
    $result = mysqli_query($link, $search);
    $row = mysqli_fetch_assoc($result);

    if(isset($row["locationName"])){
        $insertSql = <<<insertsql
        INSERT INTO rain (locationName, rain, hour24, dayRain)
        VALUES ('$locationName', $rain, $hour24, $dayRain);
        insertsql;
        mysqli_query($link, $insertSql);
    }

}
?>

<ul>
    <?php foreach($links['records']['location'] as $key=>$val) { ?>
        <li><?= $val['locationName'] ?></li>
        <li><?= $val['weatherElement'][1]['elementValue'] ?></li>
        <li><?= $val['weatherElement'][6]['elementValue'] ?></li>
        <li><?= $val['weatherElement'][7]['elementValue'] ?></li>
        <hr>
    <?php } ?>
</ul>