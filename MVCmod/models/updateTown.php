<?php

require_once './models/database.php';

class updateTown extends database{

    public function __construct(){
        $this->update();
    }

    public function update(){
        $json_url = "https://opendata.cwb.gov.tw/api/v1/rest/datastore/O-A0003-001?Authorization=CWB-6DBF737A-A676-4BC9-A35B-334E259FB4D2&elementName=TEMP&elementName=D_TX&elementName=D_TN";
        $json = file_get_contents($json_url);
        $links = json_decode($json, TRUE);

        foreach($links['records']['location'] as $key=>$val){
            $locationName = $val['locationName'];
            $temp = $val['weatherElement'][0]['elementValue'];
            $dtx = $val['weatherElement'][1]['elementValue'];
            $dtn = $val['weatherElement'][2]['elementValue'];
        
            $updateSql = <<<updatesql
            UPDATE town SET temp = $temp, D_tx = $dtx, D_tn = $dtn
            WHERE locationName = '$locationName';
            updatesql;
            $update = self::query($updateSql);
        }
    }

}

?>