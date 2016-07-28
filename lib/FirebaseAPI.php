<?php
namespace Firebase;

require_once __DIR__ . '/FirebaseCurl.php';

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
        $this->_setting['print']    = null;
        $this->_setting['shallow']  = null;
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
        $fullPath   = $this->_databaseURL.$path.".json?".http_build_query($this->_setting);
        FirebaseCurl::execCurl($this->_curl, $fullPath, $request_mode, $jsonData, $this->_setting);
    }
    /*================================================================================
       Firebase parameter setting
      ================================================================================ */ 
    /* Set parameter */
    public function setApiKey       ($str){ $this->_apiKey          = $str; }
    public function setAuthDomain   ($str){ $this->_authDomain      = $str; }     
    public function setDatabaseURL  ($str){ $this->_databaseURL     = $str; }    
    public function setStorageBucket($str){ $this->_storageBucket   = $str; }  

    /* Get parameter */
    public function getApiKey       (){ return $this->_apiKey;          }      
    public function getAuthDomain   (){ return $this->_authDomain;      }       
    public function getDatabaseURL  (){ return $this->_databaseURL;     }      
    public function getStorageBucket(){ return $this->_storageBucket;   }        
      
    /*================================================================================
       Firebase url setting
      ================================================================================ */
    public function setPrintMode($mode)
    {
        switch ($mode) {
            case "silent":
                $this->_setting['print'] = "silent"; break;
            case "pretty":
                $this->_setting['print'] = "pretty"; break;
            case "default":
                $this->_setting['print'] = null;     break;
            default:
                $this->_setting['print'] = null; 
        }
    }
    
    public function setShallow($bool)
    {
        $this->_setting['shallow'] = $bool ? "true" : null ;
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
    
    /*
     Descript:
     REST call "GET"
     Read data from our Firebase database
    */
    public function get($path)
    {
        $this->execCurl($path, "", "GET");
    }    
}


