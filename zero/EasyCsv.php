<?php

namespace Zero;

/**
* The easy CSV Class of PHP
* @author Anke 
* @version 1.0
*/
error_reporting(0);
class EasyCsv
{
    public static $type;                #json | array  
    public static $fileName;            #file name
    public static $fileOpratione;       #file opration
    public static $fileOpenHandle;      #file handle
    public static $csvMaxLength;        #csv max row
    public static $errorMsg;            #error msg

    public function __construct(){
    }

    public static function init($type,$fileName,$fileOpratione){
        self::$type = $type;
        self::$fileName = $fileName;
        self::$csvMaxLength = 1000;
        if(!file_exists($fileName)){
            self::$errorMsg = 'file is not exist!';
            return false;
        }
        if(!self::checkCSV()){
            self::$errorMsg = 'file is not csv!';
            return false;
        }
        self::$fileOpenHandle = fopen($fileName, $fileOpratione);
        return true;
    }

    public static function importCsv($feilds=[],$value=''){
        while($data=fgetcsv(self::$fileOpenHandle,self::$csvMaxLength,",")){
            $data = @eval('return '.iconv('gbk','utf-8',var_export($data,true)).';');
            $list[] = $data;
        }
        if(count($list)<2){
            self::$errorMsg = 'csv data is null!';
            return false;
        }
        if(!empty($feilds)){
            foreach($feilds as $feild){
                $unKey = array_search($feild,$list[0]);
                if(!$unKey){
                    self::$errorMsg = 'the unset row name is not exist!';
                    return false;
                }
                $list = self::_callUnkey($unKey,$list);
                if(!$list)
                    return false;
            }
        }
        if(self::$type == 'json')
            $list = json_encode($list,JSON_UNESCAPED_UNICODE);
        return $list;
    }

    public static function exportCsv($title,$data){
        try{
            fputcsv(self::$fileOpenHandle, $title);
            foreach($data as $index){
                fputcsv(self::$fileOpenHandle, $index);
            }
        }catch(Exception $e){
            self::$errorMsg = $e->getMessage();
            return false;
        }
        return true; 
    }

    public static function downloadCsv($downloadName,$title,$data){
        try{
            self::$fileName = $downloadName;
            if(!self::checkCSV()){
                self::$errorMsg = 'file is not csv!';
                return false;
            }
            $fileOpenHandle = fopen('php://output', 'a');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$downloadName);
            header('Cache-Control: max-age=0');
            fputcsv($fileOpenHandle, $title);
            foreach($data as $index){
                fputcsv($fileOpenHandle, $index);
            }
        }catch(Exception $e){
            self::$errorMsg = $e->getMessage();
            return false;
        }
        return true;
    }

    public static function checkCSV(){
        $extend = pathinfo(self::$fileName);
        if($extend['extension'] == 'csv')
            return true;
        return false;
    }

    public static function getError(){
        return self::$errorMsg;
    }

    private static function _callUnkey($unKey,$list){
        try{
            $listReturn = [];
            foreach($list as $val){
                unset($val[$unKey]);
                $listReturn[] = $val;
            }
            return $listReturn;
        }catch(Exception $e){
            self::$errorMsg = $e->getMessage();
            return false;
        }
    }

    public function __destruct(){
        fclose(self::$fileOpenHandle);
    }
}

?>