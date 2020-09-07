<?php

require_once './models/helloModel.php';
require_once './models/updateCity.php';
require_once './models/updateTown.php';

class helloC {
    public $result;
    public $detail;

    public function __construct(){
        $this->result = new helloM();

        // 載入頁面時更新縣市資訊
        $updateC = new updateCity();
    }

    // 顯示各縣市選項
    public function allCity(){
        $result = $this->result->allCityList();
        $list = "";
        foreach($result as $key=>$value){
            $list .= "<option value='$value[0]'>$value[0]</option>";
        }

        //  預設已選擇選到的縣市
        if($_GET['city']){
            $city = $_GET['city'];
            $list = "<option value='$city' selected>$city</option>" . $list;
        }

        return $list;
    }

    // 根據選擇的縣市搜尋該縣市的氣象站
    public function allTown(){
        $list = "<option value='' selected disabled>-----</option>";

        if($_GET['city']){
            $updateT = new updateTown();
            $city = $_GET['city'];
            $result = $this->result->allTownList($city);

            foreach($result as $key=>$value){
                $one = "<option value='$value[0]'>$value[1] / $value[0]</option>";
                $list .= $one;
            }
        }

        return $list;
    }

    // 顯示該縣市當前天氣資訊
    public function townShow(){
        $result = $this->result->getCity();
        $this->detail = [];

        foreach($result as $key=>$value){
            for($i = 0;$i < 12; $i++){
                $this->detail[] = $value[$i];
            }
        }
    }

    // 針對wxValue顯示不同圖片
    public function image($val){
        if($val < 3){
            return "./img/sun.png";
        }else if($val < 5){
            return "./img/sunCloud.png";
        }else if($val < 8){
            return "./img/cloud.png";
        }else{
            return "./img/rain.png";
        }
    }

    // 顯示未來兩天預報
    public function twoDay(){
        $result = $this->result->getTwo();
        $list = "";

        $i = 0;
        foreach($result as $key=>$value){
            $i++;
            if($i > 4){
                break;
            }

            $image = $this->image($value[5]);

            $one = <<<oneIt
            <div>
                    <h3>$value[2]</h3>
                    <img src="$image" alt="">
                    <p>$value[4]</p>
                    <p>$value[6]&deg;C | $value[3]%</p>
                </div>
            oneIt;

            $list .= $one;
        }

        return $list;
    }

    // 顯示未來一週預報
    public function oneWeek(){
        $result = $this->result->getWeek();
        $list = "";

        $count = 0;
        foreach($result as $key=>$value){
            if($count%2 == 0){
                $list .= $this->showUp($value);
            }else{
                $list .= $this->showDown($value);
            }
            $count++;
        }

        return $list;
    }

    // 在未來一週的區塊, 上午的放上面
    public function showUp($value){
        $image = $this->image($value[5]);
        $one = <<<oneIt
            <div class="oneday">
                <div class="up">
                    <h3>$value[2]</h3>
                    <img src="$image" alt="">
                    <p>$value[4]</p>
                    <p>$value[6]&deg;C | $value[3]%</p>
                </div>
                <hr>
        oneIt;
        return $one;
    }

    // 在未來一週的區塊, 下午的放下面
    public function showDown($value){
        $image = $this->image($value[5]);
        $one = <<<oneIt
                <div class="down">
                    <h3>$value[2]</h3>
                    <img src="$image" alt="">
                    <p>$value[4]</p>
                    <p>$value[6]&deg;C | $value[3]%</p>
                </div>
            </div>
        oneIt;
        return $one;
    }

}

?>