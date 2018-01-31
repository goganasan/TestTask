<?php

require_once(__ROOT__ . '/TestTask/api/Weather.php');

class WorldWeatherOnline
{
    //Own API key
    public $apiKey = '6a5dae9412734bd397c162639182901';

    //Form url,
    //@param array $data
    //@param string $request
    public function getUrl($data,$request)
    {
        if (is_array($data)) {
            foreach ($data as $name => $value) {
                $arr[] = $name.'='.urlencode($value);
            }
        }

        if (is_array($arr)) {
            $url = join('&', $arr);
        }

        return $request.$url.'&key='.$this->apiKey;
    }

    //Set Api key if it was changed
    public function setKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getData($url, $format)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $result = curl_exec($ch);
        curl_close($ch);

        if ($format == 'xml') {
            $data = new \SimpleXMLElement($result);
        } elseif ($format == 'json') {
            $data = json_decode($result);
        } else {
            return 'Ошибка формата данных';
        }

        return new Weather($data);
    }
}