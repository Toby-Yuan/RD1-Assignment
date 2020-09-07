<?php

require_once './models/townsModel.php';

class townsC {
    public $result;

    public function __construct(){
        $this->result = new townsM();
    }

    public function show(){
        $result = $this->result->get();
        $list = "";

        foreach($result as $key=>$value){
            $detail = $this->getDetail($value[0]);
            $one = <<<oneIt
            <div class="townOne">
                <h2>$value[0]</h2>
                $detail
            </div>
            oneIt;

            $list .= $one;
        }
        return $list;
    }

    public function getDetail($city){
        $result = $this->result->catch($city);
        $list = "";

        $i = 0;
        foreach($result as $key=>$value){
            if($i >= 4){
                break;
            }
            $image = $this->image($value[4]);
            $one = <<<oneIt
            <div>
                <h3>$value[2]</h3>
                <img src="./img/$image" alt="">
                <p>$value[3]</p>
                <p>$value[6]&deg;C | $value[5]%</p>
            </div>
            oneIt;

            $list .= $one;
            $i++;
        }
        return $list;
    }

    public function image($val){
        if ($val < 3){
            return "sun.png";
        }else if($val < 5){
            return "sunCloud.png";
        }else if($val < 8){
            return "cloud.png";
        }else{
            return "rain.png";
        }
    }
}

?>