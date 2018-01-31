<?php

class Wind
{
    public $windspeed; //int
    public $winddir;   //int

    public function __construct($speed)
    {
        $this->windspeed = $speed;
    }

    public function windDir($dir)
    {
        return $this->winddir = $dir;
    }
}