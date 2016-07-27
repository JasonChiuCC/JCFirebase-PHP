<?php
namespace Firebase;

require_once __DIR__ . '/FirebaseCurl.php';

function ls($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";  
}

class FirebaseAPI
{
    # Firebase realtime parameter
    private $_apiKey;
    private $_authDomain;
    private $_databaseURL;
    private $_storageBucket;

    # Crul parameter
    private $_curl;
    
    function __construct($config = '',$debugLanguage = '')
    {
        # Set debug language
        if(empty($debugLanguage)){
            include('Language/en.php');
        } else {            
            include('Language/'.$debugLanguage.'.php');                        
        }        
                      
        if(empty($config)){
            trigger_error($lang['E_Config_IS_Empty'], E_USER_ERROR);
        }
        
        # Init default variable
        $this->_apiKey          = $config['apiKey'];
        $this->_authDomain      = $config['authDomain'];
        $this->_databaseURL     = $config['databaseURL'];
        $this->_storageBucket   = $config['storageBucket'];  
        
        # Init curl
        $this->initCurl();
    }
    
    function __destruct() 
    {
        # Close curl
        $this->closeCurl();
    }    
    
    public function initCurl()
    {
        FirebaseCurl::initCurl($this->_curl); 
    }
    
    public function closeCurl()
    { 
        FirebaseCurl::closeCurl($this->_curl); 
    }
    
    /*
     Descript:
     REST call "PUT", JavaScript SDK call "set"
     It will overwrite the data at the specified location, including any child nodes.
    */
    public function set($path, $arrayData)
    {
        $jsonData  = json_encode($arrayData);
        $path = $this->_databaseURL.$path.".json";
        FirebaseCurl::execCurl($this->_curl,$path, "PUT", $jsonData); 
    }
    
    /*
     Descript:
     REST call "PATCH", JavaScript SDK call "update"
     Update some of the keys for a defined path without replacing all of the data.
    */    
    public function update($path, $arrayData)
    {
        $jsonData  = json_encode($arrayData);
        $path = $this->_databaseURL.$path.".json";
        FirebaseCurl::execCurl($this->_curl,$path, "PATCH", $jsonData); 
    }
    
    /*
     Descript:
     REST call "POST", JavaScript SDK call "push"
     Generate a unique, timestamp-based key for every child 
    */    
    public function push($path, $arrayData)
    {
        $jsonData  = json_encode($arrayData);
        $path = $this->_databaseURL.$path.".json";
        FirebaseCurl::execCurl($this->_curl,$path, "POST", $jsonData); 
    }       
}


















