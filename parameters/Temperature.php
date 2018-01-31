<?php

class Temperature
{
    public $temp_C;  //int
    //public $temp_F;  //int

    public function __construct($data)
    {
        $this->temp_C = $data;
    }
}