<?php

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/TestTask/api/WorldWeatherOnline.php');

$weather = new WorldWeatherOnline();

array_pop($_POST);

$url = $weather->getUrl($_POST,'http://api.worldweatheronline.com/premium/v1/weather.ashx?');

$data = $weather->getData($url, $_POST['format']);

$save_log = $data->seveLog($_POST['format']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Result</title>
    </head>
<body>
    <style>
        body{
            background: url(img/img.png) 60% 0% no-repeat;
        }
        .column{
            width:400px;
            display: inline-block;
        }
        #data{
            margin: 50px;
            font-family: 'Times New Roman', Times, serif;
            font-size: 150%;
        }
    </style>
    <div id="data">
        <div>
            <p><b class="column">Выбранная локация:</b> <?= $data->city ?></p>
        </div>
        <div>
            <p><b class="column">Время наблюдения:</b> <?= $data->observation_time ?></p>
        </div>
        <div>
            <p><b class="column">Температура, &#8451:</b> <?= $data->temperature->temp_C ?></p>
        </div>
        <div>
            <p><b class="column">Скорость ветра, км/ч:</b> <?= $data->windspeed->windspeed ?></p>
        </div>
        <div>
            <p><b class="column">Направление ветра:</b> <?= $data->winddir ?></p>
        </div>
        <div>
            <p><b class="column">Влажность, г/м3:</b> <?= $data->humidity->humidity ?></p>
        </div>
        <div>
            <p><b class="column">Атм. давление, Па:</b> <?= $data->pressure->pressure?></p>
        </div>
        <div>
            <p><b class="column">Осадки, мм:</b> <?= $data->precipitation->presipitation ?></p>
        </div>
    </div>
</body>
</html>