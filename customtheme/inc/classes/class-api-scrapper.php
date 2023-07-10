<?php

namespace CUSTOM_THEME\Inc\Classes;

use CUSTOM_THEME\Inc\Traits\Singleton;

class API_Scrapper{
    use Singleton;

    protected function __construct(){

        echo "<br>We are in the class-api-scrapper.php file<br>";

    }


    protected function getEndpointReady($url, $querry_params){  // aux function

        $url = str_contains($url, "https://") ? $url : "https://" . $url;

        $is_valid_url = filter_var($url, FILTER_VALIDATE_URL);  // validating if the url format is right or not
        if(!$is_valid_url) return false;    // error handeling

        $endpoint = $url;
        
        if(is_array($querry_params) && ! empty($querry_params)){
            $endpoint = substr($endpoint, -1) === "/" ? ($endpoint . "?") : ($endpoint . "/?");  // checking if the last letter of url is a slash "/" or not
            
            // loop through this array and add it to the url
            foreach ($querry_params as $key => $value) {
                $endpoint = sprintf($endpoint . "%s=%s&", $key, $value);
            }
            $endpoint = rtrim($endpoint, "&");
        }

        return $endpoint;

    }


    public function getApiData($url, $querry_params=[]){

        $endpoint = $this->getEndpointReady($url, $querry_params);

        $json_result = wp_remote_retrieve_body( wp_remote_get($endpoint));
        $results = json_decode($json_result);

        if(!is_array($results) || empty($results)) return false;    // error handeling

        print_r($results[0]);
        wp_die();

        /*
        wp_remote_post( admin_url( 'admin-ajax.php?action=getApiData', [
            'blocking' => false,    // it will NOT block the other functionality of website and wait till the req is completed
            'sslverify' => false,
            'body' => [],   // add your parameters here


        ] ));
        */
        
    }


    
        
    
}