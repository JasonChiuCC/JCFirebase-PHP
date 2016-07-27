<?php
namespace Firebase;

class FirebaseCurl
{
    public static function initCurl(&$curl)
    {
        $curl = curl_init();
    }
    
    public static function closeCurl(&$curl)
    {
        curl_close($curl);
    }
    
    public static function execCurl(&$curl, $path, $request_mode, $jsonData)
    {
        curl_setopt($curl, CURLOPT_URL, $path);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST,   $request_mode);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,  true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,  false);
        curl_setopt($curl, CURLOPT_POSTFIELDS,      $jsonData);
        $output = curl_exec($curl);
        echo $output;
    }
}
