<?php
require_once './controllers/helloController.php';
$test = new helloC();
$test->townShow();
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>個人氣象站</title>
    <link rel="stylesheet" href="./CSS/style2.css">
</head>
<body>
    
    <form action="" method="post">
        <select name="city" id="city">
            <option value="" selected disabled>-----</option>
            <?= $test->allCity() ?>
        </select>
        <select name="town" id="town">
            <?= $test->allTown() ?>
        </select>
        <input type="submit" value="送出" name="submit">
    </form>

    <div id="oneDay">
        <div id="left">
            <h1><?= $test->detail[0] ?>/ <span><?= $test->detail[1] ?></span></h1>
            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($test->detail[5]) ?>" alt="城市景點" id="cityImg">
        </div>
        <div id="right">
            <!-- 顯示狀況和溫度 -->
            <div id="showDetail">
                <div id="wx">
                    <img src="<?= $test->image($test->detail[3]) ?>" alt="天氣狀況">
                    <p><?= $test->detail[2] ?></p>
                </div>

                <!-- 顯示溫度 -->
                <div id="showTemp">
                    <h2><?= ($test->detail[6] != -99) ? $test->detail[6] : "--" ?>&deg;C</h2>
                </div>

                <!-- 顯示最高和最低 -->
                <div id="temp">
                    <h3><span>&Delta;</span><?= ($test->detail[8] != -99) ? $test->detail[8] : "--" ?></h3>
                    <h3><span>&nabla;</span><?= ($test->detail[7] != -99) ? $test->detail[7] : "--" ?></h3>
                </div>
            </div>

            <!-- 顯示雨消息 -->
            <div id="rain">
                <h4>降雨機率 <?= $test->detail[4] ?> </h4>
                <h4>本日累積 <?= $test->detail[11] ?></h4>
                <h4>1小時累積 <?= ($test->detail[9] != -998) ? $test->detail[8] : "--" ?></h4>
                <h4>1天累積 <?= $test->detail[10] ?></h4>
            </div>
        </div>
    </div>

    <div id="twoDay">
        <h1>未來兩天</h1>

        <div id="twoDayList">
            <?= $test->twoDay() ?>
        </div>
    </div>

    <div id="oneweek">
        <h1>未來一週</h1>
        <?= $test->oneWeek() ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){

            // 下拉式選單連動
            $("#city").on("change", function(){
                var s = $("#city option:selected").text();
	            window.location = "http://localhost:8888/RD1-Assignment/MVCmod/hello?city=" + s;
            });

        });
    </script>
</body>
</html>