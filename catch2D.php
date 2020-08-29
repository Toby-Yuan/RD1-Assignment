<?php
$json_url = "https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-089?Authorization=CWB-6DBF737A-A676-4BC9-A35B-334E259FB4D2";
$json = file_get_contents($json_url);
$links = json_decode($json, TRUE);
$i = 0;


foreach($links['records']['locations'][0]['location'] as $key => $val){
    echo $val['locationName'] . '<br>';

    echo $val['weatherElement'][0]['description'] . '<br>';
    foreach($val['weatherElement'][0]['time'] as $key2 => $val2){
        echo $val2['startTime'] . '<br>';
        echo $val2['elementValue'][0]['value'] . '<br>';
        $startTime = $val2['startTime'];

        foreach($val['weatherElement'][1]['time'] as $key3 => $val3){
            if($val3['startTime'] == $startTime){
                echo $val3['elementValue'][0]['value'] . '<br>';
                echo $val3['elementValue'][1]['value'] . '<br>';
            }
        }

        foreach($val['weatherElement'][3]['time'] as $key4 => $val4){
            if($val4['dataTime'] == $startTime){
                echo $val4['elementValue'][0]['value'] . '<br>';
            }
        }
    }

    echo "<hr>";
}
?>

