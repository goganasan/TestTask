<?php
if (isset($_POST['choose']) && isset($_POST['q']) && isset($_POST['date']) && isset($_POST['format'])) {
    header('location: result.php' );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <style>
        body{
            background: url(img/img.png) 60% 0 no-repeat;
        }
        #data{
            margin: 50px;
            font-family: 'Times New Roman', Times, serif;
            font-size: 150%;
        }
    </style>
    <div id="data">
        <h1>ПОГОДА В ВАШЕМ ГОРОДЕ</h1>
        <form method="post" action="result.php">
            <div>
                <h4>укажите локацию</h4>
                <input name="q" type="text">
            </div>
            <div>
                <h4>выберите дату</h4>
                <input name="date" type="date">
            </div>
    <!--        <div>-->
    <!--            <h4>формат температуры</h4>-->
    <!--            <input name="temp" type="radio"  id="celsius" value="0" checked>-->
    <!--            <label for="celsius">&#8451</label>-->
    <!--            <input name="temp" type="radio"  id="fahrenheit" value="1">-->
    <!--            <label for="fahrenheit">&#8457</label>-->
    <!--        </div>-->
            <div>
                <h4>тип запроса</h4>
                <input name="format" type="radio"  id="json" value="json" checked>
                <label for="json">json</label>
                <input name="format" type="radio"  id="xml" value="xml">
                <label for="xml">xml</label>
            </div>
            <p>
                <input type="submit" name="choose" value="ПОСМОТРЕТЬ"/>
            </p>
        </form>
    </div>

</body>
</html>