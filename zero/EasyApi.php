<?php

namespace Zero;

/**
* The easy api Class of PHP
* @author Anke 
* @version 1.0
*/
class EasyApi
{
    public $initParam;
    private $curl;
    public static $response;

    public function __construct()
    {
        
    }

    public function init($initParam)
    {
        $this->initParam = $initParam;
        return $this;
    }

    public function checkDomain()
    {
        $urlArr = parse_url($this->initParam['url']);
        $pingParam = (strcasecmp(PHP_OS, 'Linux') === 0) ? '-c' : '-n';
        $pingShell = "ping {$pingParam} 1 {$urlArr['host']}";
        exec($pingShell, $pingOut, $status);
        if($status !== 0 && empty($pingOut))
            self::$response = false;
        self::$response = true;
    }

    public function signature()
    {
        sort($this->initParam, SORT_STRING);
        $signature = implode($this->initParam);
        self::$response = sha1($signature);
    }

    public function xml()
    {
        $xml = "<xml>";
        foreach ($this->initParam as $key=>$val)
        {
            if (is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                 $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml.="</xml>";
        $this->initParam = $xml;
        return $this;
    }

    public function json()
    {
        $this->initParam = json_encode($this->initParam);
        return $this;
    }

    public function post($formart = 'json')
    {
        $this->curlInit();
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->initParam['param']);
        $response = curl_exec($this->curl);
        $this->curlClose();
        self::$response = json_decode($response);
        if($formart == 'xml')
            self::$response = $this->xmlToArray($response);
    }

    public function get($formart = 'json')
    {
        $this->curlInit();
        $response = curl_exec($this->curl);
        $this->curlClose();
        self::$response = json_decode($response);
        if($formart == 'xml')
            self::$response = $this->xmlToArray($response);
    } 

    public function delete()
    {

    }
    
    private function xmlToArray($xml){
        libxml_disable_entity_loader(true);
        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);        
    }

    private function curlInit()
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_URL, $this->initParam['url']);
        curl_setopt($this->curl, CURLOPT_HEADER, 0);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_REFERER, '');
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        if($this->initParam['method'] == 'post')
            curl_setopt($this->curl, CURLOPT_POST, 1);
    } 

    private function curlClose()
    {
        curl_close($this->curl);
    }

    public function __destruct()
    {
    
    }
}