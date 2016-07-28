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

    # Other setting
    private $_setting = array();

    # Crul parameter
    private $_curl;

    /*================================================================================
       Private function
      ================================================================================ */
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

        # Init firebase setting
        $this->_initSetting();

        # Init curl
        $this->_initCurl();
    }

    function __destruct()
    {
        # Close curl
        $this->_closeCurl();
    }

    private  function _initSetting()
    {
        $this->_setting['silent']       = 0;
        $this->_setting['prettyPrint']  = 0;
    }

    private  function _initCurl()
    {
        FirebaseCurl::initCurl($this->_curl);
    }

    private  function _closeCurl()
    {
        FirebaseCurl::closeCurl($this->_curl);
    }

    private function execCurl($path, $arrayData = '', $request_mode)
    {
        $jsonData   = json_encode($arrayData);
        $fullPath   = $this->_databaseURL.$path.".json?";
        FirebaseCurl::execCurl($this->_curl, $fullPath, $request_mode, $jsonData, $this->_setting);
    }

    /*================================================================================
       Firebase setting
      ================================================================================ */
    public function setSilent($bool)
    {
        $this->_setting['silent']       = $bool ? 1 : 0;
    }
    public function setPrettyPrint($bool)
    {
        $this->_setting['prettyPrint']  = $bool ? 1 : 0;
    }

    /*================================================================================
       Firebase REST API
      ================================================================================ */
    /*
     Descript:
     REST call "PUT", JavaScript SDK call "set"
     It will overwrite the data at the specified location, including any child nodes.
    */
    public function set($path, $arrayData)
    {
        $this->execCurl($path, $arrayData, "PUT");
    }

    /*
     Descript:
     REST call "PATCH", JavaScript SDK call "update"
     Update some of the keys for a defined path without replacing all of the data.
    */
    public function update($path, $arrayData)
    {
        $this->execCurl($path, $arrayData, "PATCH");
    }

    /*
     Descript:
     REST call "POST", JavaScript SDK call "push"
     Generate a unique, timestamp-based key for every child
    */
    public function push($path, $arrayData)
    {
        $this->execCurl($path, $arrayData, "POST");
    }

    /*
     Descript:
     REST call "DELETE", JavaScript SDK call "remove"
     Remove data from the specified Firebase database reference
    */
    public function remove($path)
    {
        $this->execCurl($path, "", "DELETE ");
    }

    /*
     Descript:
     Server Values, set a timestamp(UNIX epoch)
    */
    public function setSV($path)
    {
        $arrayData = array(
            ".sv"      => "timestamp",
        );
        $this->execCurl($path, $arrayData, "PUT");
    }
}


