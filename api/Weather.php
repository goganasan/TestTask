<?php

require_once(__ROOT__ . '/TestTask/parameters/Humidity.php');
require_once(__ROOT__ . '/TestTask/parameters/Precipitation.php');
require_once(__ROOT__ . '/TestTask/parameters/Pressure.php');
require_once(__ROOT__ . '/TestTask/parameters/Temperature.php');
require_once(__ROOT__ . '/TestTask/parameters/Wind.php');


class Weather
{

    public $city;
    public $observation_time;
    public $temperature;
    public $windspeed;
    public $winddir;
    public $humidity;
    public $pressure;
    public $precipitation;

    public function __construct($data)
    {
        if ($data instanceof \SimpleXMLElement) {
            $this->city             = $data->request->query;
            $this->observation_time = $data->current_condition->observation_time;
            $this->temperature      = new Temperature($data->current_condition->temp_C);
            $this->humidity         = new Humidity($data->current_condition->humidity);
            $this->pressure         = new Pressure($data->current_condition->pressure);
            $this->windspeed        = new Wind($data->current_condition->windspeedKmph);
            $this->winddir          = $this->windspeed->winddir($data->current_condition->winddir16Point);
            $this->precipitation    = new Precipitation($data->current_condition->precipMM);
            $format = 'xml';
        } else {
            $this->city             = $data->data->request[0]->query;
            $this->observation_time = $data->data->current_condition[0]->observation_time;
            $this->temperature      = new Temperature($data->data->current_condition[0]->temp_C);
            $this->humidity         = new Humidity($data->data->current_condition[0]->humidity);
            $this->pressure         = new Pressure($data->data->current_condition[0]->pressure);
            $this->windspeed        = new Wind($data->data->current_condition[0]->windspeedKmph);
            $this->winddir          = $this->windspeed->winddir($data->data->current_condition[0]->winddir16Point);
            $this->precipitation    = new Precipitation($data->data->current_condition[0]->precipMM);
            $format = 'json';
        }
    }

    public function seveLog($format)
    {
        if ($format == 'xml') {
            $arr = ['скорость ветра' => $this->windspeed->windspeed, 'температура' => $this->temperature->temp_C,'дата' => (new \DateTime())->format('Y-m-d'), 'направление ветра' => $this->winddir,
                'город' => $this->city, 'влажность' => $this->humidity->humidity, 'давление' => $this->pressure->pressure, 'осадки' => $this->precipitation->presipitation];
            $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><root/>');
            array_walk_recursive($arr, array ($xml, 'addChild'));
            $arr = $xml->asXML();
        } else {
            $arr = json_encode(['дата' => (new \DateTime())->format('Y-m-d'), 'температура' => $this->temperature->temp_C, 'направление ветра' => $this->winddir, 'город' => $this->city,
                'влажность' => $this->humidity, 'давление' => $this->pressure, 'скорость ветра' => $this->windspeed->windspeed, 'осадки' => $this->precipitation->presipitation], JSON_UNESCAPED_UNICODE);
        }

        file_put_contents('log.txt', $arr,FILE_APPEND);

        return $arr;
    }
}