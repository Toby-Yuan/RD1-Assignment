<?php

require_once("connect.php");

$searchCity = "SELECT * FROM `city36hr`";
$resultCity = mysqli_query($link, $searchCity);

$cityName = "縣市";
$towmLocation = "鄉鎮站名";
$rainP = "%";

require_once("getToday.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>個人氣象站</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="box">

        <!-- 顯示當日 -->
        <div id="left">

            <!-- 選擇地區 -->
            <form id="selectCity" method="POST">
                <select name="city" id="city">
                    <option value="" selected disabled>-----</option>
                    <?php while($city = mysqli_fetch_assoc($resultCity)){ ?>
                        <option value="<?= $city['locationName'] ?>"><?= $city['locationName'] ?></option>
                    <?php } ?>
                    
                    <!-- <option value="1">縣市</option>
                    <option value="2">縣市</option>
                    <option value="3">縣市</option> -->
                </select>
                <select name="town" id="town">
                    <option value="" selected disabled>-----</option>
                </select>
                <input type="submit" value="送出" name="submit">
            </form>

            <!-- 顯示區域 -->
            <div id="show">
                <h1><?= $cityName ?>/ <span><?= $towmLocation ?></span></h1>
                <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($image['image']) ?>" alt="城市景點" id="cityImg">

                <!-- 顯示狀況和溫度 -->
                <div id="showDetail">
                    <div id="wx">
                        <img src="<?= $howsW ?>" alt="天氣狀況">
                        <p><?= $image["wxName"] ?></p>
                    </div>

                    <!-- 顯示溫度 -->
                    <div id="showTemp">
                        <h2><?= $town["temp"] ?>&deg;C</h2>

                        <!-- 顯示最高和最低 -->
                        <div id="temp">
                            <h3><span>&Delta;</span><?= $town["D_tx"] ?></h3>
                            <h3><span>&nabla;</span><?= $town["D_tn"] ?></h3>
                        </div>
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

        <!-- 顯示未來 -->
        <div id="right">
            <form action="" method="post" id="selectDay">
                <input type="submit" value="未來兩天" name="twoDay">
                <input type="submit" value="未來一週" name="senDay">
            </form>

            <div id="showD">
                <h1>未來兩天</h1>

                <div class="oneDayBox">
                    <div class="time">2020-08-28 12:00:00</div>
                    <img src="sun.png" alt="">
                    <div class="showDetailD">
                        <h1>24&deg;C</h1>
                        <hr>
                        <h1>40%</h1>
                    </div>
                </div>

                <div class="oneDayBox">
                    <div class="time">2020-08-28 12:00:00</div>
                    <img src="sun.png" alt="">
                    <div class="showDetailD">
                        <h1>24&deg;C</h1>
                        <hr>
                        <h1>40%</h1>
                    </div>
                </div>

                <div class="oneDayBox">
                    <div class="time">2020-08-28 12:00:00</div>
                    <img src="sun.png" alt="">
                    <div class="showDetailD">
                        <h1>24&deg;C</h1>
                        <hr>
                        <h1>40%</h1>
                    </div>
                </div>

                <div class="oneDayBox">
                    <div class="time">2020-08-28 12:00:00</div>
                    <img src="sun.png" alt="">
                    <div class="showDetailD">
                        <h1>24&deg;C</h1>
                        <hr>
                        <h1>40%</h1>
                    </div>
                </div>
            </div>
        </div>
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