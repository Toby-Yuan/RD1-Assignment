<?php
$json_url = "https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-C0032-001?Authorization=CWB-6DBF737A-A676-4BC9-A35B-334E259FB4D2";
$json = file_get_contents($json_url);
$links = json_decode($json, TRUE);
?>

<ul>
    <li>
        <p><?= $links['records']['location'][0]['locationName'] ?></p>
    </li>
</ul>

<hr>

<ul>
    <?php foreach($links['records']['location'] as $key=>$val) { ?>
        <li><?= $val['locationName'] ?></li>
        <li><?= $val['weatherElement'][0]['elementName'] ?></li>
        <li><?= $val['weatherElement'][0]['time'][0]['startTime'] ?></li>
        <li><?= $val['weatherElement'][0]['time'][0]['parameter']['parameterName'] ?></li>
        <hr>
    <?php } ?>
</ul>