<?php

require_once("connect.php");

require_once("update/updateCity.php");
require_once("update/updateTown.php");
require_once("update/updateRain.php");
require_once("update/update2D.php");
require_once("update/update7D.php");

$searchCity = "SELECT * FROM `city36hr`";
$resultCity = mysqli_query($link, $searchCity);

$cityName = "縣市";
$towmLocation = "鄉鎮站名";
$rainP = "%";

require_once("getToday.php");

$searchTwo = "SELECT * FROM twoDay WHERE locationName = '$cityName'";
$resultTwo = mysqli_query($link, $searchTwo);

$searchWeek = "SELECT * FROM oneWeek WHERE locationName = '$cityName'";
$resultWeek = mysqli_query($link, $searchWeek);

?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>個人氣象站</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    
    <form action="" method="post">
        <select name="city" id="city">
            <option value="" selected disabled>-----</option>
            <?php while($city = mysqli_fetch_assoc($resultCity)){ ?>
                <option value="<?= $city['locationName'] ?>"><?= $city['locationName'] ?></option>
            <?php } ?>
        </select>
        <select name="town" id="town">
            <option value="" selected disabled>-----</option>
        </select>
        <input type="submit" value="送出" name="submit">
    </form>

    <div id="oneDay">
        <div id="left">
            <h1><?= $cityName ?>/ <span><?= $towmLocation ?></span></h1>
            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($image['image']) ?>" alt="城市景點" id="cityImg">
        </div>
        <div id="right">
            <!-- 顯示狀況和溫度 -->
            <div id="showDetail">
                <div id="wx">
                    <img src="<?= $howsW ?>" alt="天氣狀況">
                    <p><?= $image["wxName"] ?></p>
                </div>

                <!-- 顯示溫度 -->
                <div id="showTemp">
                    <h2><?= $town["temp"] ?>&deg;C</h2>
                </div>

                <!-- 顯示最高和最低 -->
                <div id="temp">
                    <h3><span>&Delta;</span><?= $town["D_tx"] ?></h3>
                    <h3><span>&nabla;</span><?= $town["D_tn"] ?></h3>
                </div>
            </div>

            <!-- 顯示雨消息 -->
            <div id="rain">
                <h4>降雨機率 <?= $rainP ?> </h4>
                <h4>本日累積 <?= $town["dayRain"] ?></h4>
                <h4>1小時累積 <?= $town["rain"] ?></h4>
                <h4>1天累積 <?= $town["hour24"] ?></h4>
            </div>
        </div>
    </div>

    <div id="twoDay">
        <h1>未來兩天</h1>

        <div id="twoDayList">
            <?php while($two = mysqli_fetch_assoc($resultTwo)) { ?>
                <div>
                    <h3><?= $two["startTime"] ?></h3>

                    <?php 
                        if($two["wxValue"] < 3){
                            $howsWT = "sun.png";
                        }elseif($two["wxValue"] < 5){
                            $howsWT = "sunCloud.png";
                        }elseif($two["wxValue"] < 8){
                            $howsWT = "cloud.png";
                        }else{
                            $howsWT = "rain.png";
                        }
                    ?>
                    <img src="<?= $howsWT ?>" alt="">
                    <p><?= $two["wxName"] ?></p>
                    <p><?= $two["temp"] ?>&deg;C | <?= $two["rainP"] ?>%</p>
                </div>
            <?php } ?>
        </div>
    </div>

    <div id="oneweek">
        <h1>未來一週</h1>

        <?php while($week = mysqli_fetch_assoc($resultWeek)) { ?>
            <div class="oneday">
                <div class="up">
                    <h3><?= $week['startTime'] ?></h3>

                    <?php 
                        if($week["wxValue"] < 3){
                            $howsWT = "sun.png";
                        }elseif($week["wxValue"] < 5){
                            $howsWT = "sunCloud.png";
                        }elseif($week["wxValue"] < 8){
                            $howsWT = "cloud.png";
                        }else{
                            $howsWT = "rain.png";
                        }
                    ?>

                    <img src="<?= $howsWT ?>" alt="">
                    <p><?= $week['wxName'] ?></p>
                    <p><?= $week['temp'] ?>&deg;C | <?= $week['rainP'] ?>%</p>
                </div>
                <hr>

                <?php $week = mysqli_fetch_assoc($resultWeek); ?>
                <div class="down">
                    <h3><?= $week['startTime'] ?></h3>

                    <?php 
                        if($week["wxValue"] < 3){
                            $howsWT = "sun.png";
                        }elseif($week["wxValue"] < 5){
                            $howsWT = "sunCloud.png";
                        }elseif($week["wxValue"] < 8){
                            $howsWT = "cloud.png";
                        }else{
                            $howsWT = "rain.png";
                        }
                    ?>

                    <img src="<?= $howsWT ?>" alt="">
                    <p><?= $week['wxName'] ?></p>
                    <p><?= $week['temp'] ?>&deg;C | <?= $week['rainP'] ?>%</p>
                </div>
            </div>
        <?php } ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){

            // 下拉式選單連動
            $("#city").on("change", function(){
                var s = $("#city option:selected").text();
	            $.get('getLetterNumber.php?letter=' + s, letterChangeDataBack);
            });

            function letterChangeDataBack(data) {
                $("#town").html(data);
            };

        });
    </script>
</body>
</html>