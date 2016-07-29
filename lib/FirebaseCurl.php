<?php
namespace Firebase;

class FirebaseCurl
{
    public static function printResult($result, $setting)
    {
        if( strcmp( $setting['print'], 'silent') == 0 ){ return 0; }  
        if( strcmp( $setting['print'], 'pretty') == 0 )
        {
            echo "<pre>";
            $json = json_decode($result);
            var_dump(json_encode($json, JSON_PRETTY_PRINT));
            echo "</pre>";
        }
        else
        {
            echo $result;
        }
    }

    public static function initCurl(&$curl)
    {
        $curl = curl_init();
    }

    public static function closeCurl(&$curl)
    {
        curl_close($curl);
    }

    public static function execCurl(&$curl, $path, $request_mode, $jsonData, $firebaseSetting)
    {
        curl_setopt($curl, CURLOPT_URL, $path);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST,   $request_mode);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,  true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,  false);
        curl_setopt($curl, CURLOPT_POSTFIELDS,      $jsonData);
        $result = curl_exec($curl);
        if(!curl_errno($curl))
        {
            /*$info = curl_getinfo($curl);*/
            self::printResult($result, $firebaseSetting);
        }
        return $result;
    }
}
