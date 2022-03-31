<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Weather
 *
 * @author webre
 */
require("autoload.php");

class Weather implements Weather_Interface {

    //put your code here
    private $url;

    public function __construct() {


       
    }

    public function get_cities() {
        $str = file_get_contents(__CITIES_FILE);
        $json = json_decode($str,true);
        $cities= [];

        foreach($json as $city)
        {
            if ($city["country"] == "EG") $cities[] = $city;
        }

        return $cities;

   
    }

    public function get_weather($cityid) {
        try
        {
            $curl = curl_init(__WEATHER_URL1.$cityid.__WEATHER_URL2);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            return curl_exec($curl);
        }
        catch(Exception $exception)
        {
            return json_encode([
                "status"=>501,
                "message"=>"Gateway error"
            ]);
        }
      
    }

    public function get_weather_guzzle($cityid){

        $this->url = __WEATHER_URL1.$cityid.__WEATHER_URL2 ; 
        var_dump($this->url);

        try{
        $client = new \GuzzleHttp\Client();
        $response = $client->get($this->url);
        return $response->getBody();
        }
        catch(Exception $e)
        {
            return json_encode([
                "status"=>501,
                "message"=>"Gateway error"
            ]);
        }

    }

    public function get_current_time() {
        return time();
        
    }

}
