<?php
require_once './controllers/townsController.php';
$test = new townsC();
$test->result->getTown();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/townsStyle.css">
</head>
<body>
    <div id="box">
        <h1><?= $_GET['city'] ?>鄉鎮未來兩天預報 <a href="./hello">回到主頁</a></h1>
        

        <div id="town">
            <?= $test->show() ?>
        </div>
    </div>
</body>
</html>