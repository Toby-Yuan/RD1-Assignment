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
            <form id="selectCity">
                <select name="city" id="city">
                    <option value="1">縣市</option>
                    <option value="2">縣市</option>
                    <option value="3">縣市</option>
                </select>
                <select name="town" id="town">
                    <option value="1">鄉鎮</option>
                    <option value="2">鄉鎮</option>
                    <option value="3">鄉鎮</option>
                </select>
                <input type="submit" value="送出">
            </form>

            <!-- 顯示區域 -->
            <div id="show">
                <h1>縣市/ <span>鄉鎮站名</span></h1>
                <img src="https://fakeimg.pl/360x240/" alt="" id="cityImg">

                <!-- 顯示狀況和溫度 -->
                <div id="showDetail">
                    <img src="https://fakeimg.pl/136/" alt="">

                    <!-- 顯示溫度 -->
                    <div id="showTemp">
                        <h2>溫度</h2>

                        <!-- 顯示最高和最低 -->
                        <div id="temp">
                            <h3><span>&Delta;</span>最高</h3>
                            <h3><span>&nabla;</span>最低</h3>
                        </div>
                    </div>
                </div>

                <!-- 顯示雨消息 -->
                <div id="rain">
                    <h2>降雨機率</h2>
                    <h2>本日累積</h2>
                    <h2>1小時累積</h2>
                    <h2>1天累積</h2>
                </div>
            </div>
        </div>

        <!-- 顯示未來 -->
        <div id="right"></div>
    </div>
</body>
</html>