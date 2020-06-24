<?php

class Response 
{
    public static function sendMsg($data)
    {
        echo json_encode($data);
    }
}

class ResponseError 
{
    public static function sendMsg($errorMsg)
    {
        $ret = array();
        $ret['Error'] = true;
        $ret['ErrorMessage'] = $errorMsg;
        echo json_encode($ret);
    }
}

class RequestValidator 
{
    public static function isValidNumeric($param) 
    {
        return $param != '' && strlen($param) > 0 && is_numeric($param);
    }
}

class Utilities 
{
    public static function getDataKeyName($userId, $className)
    {
        $keyName = $userId.'_'.$className;
        return $keyName;
    }
    
    public static function array_overlay($arr1, $arr2)
    {
        foreach($arr1 as $key => $value) {
            
            if(!array_key_exists($key,$arr2)) continue;
            
            if(is_array($value) && is_array($arr2[$key]))
            {
                $arr1[$key] = Utilities::array_overlay($value,$arr2[$key]);
            } 
            else 
            {
                $arr1[$key] = $arr2[$key];
            }
        }
        return $arr1;
    }
    
    public static function &array_merge_recursive_distinct(array &$array1, &$array2 = null)
    {
        $merged = $array1;
        
        if (is_array($array2))
            foreach ($array2 as $key => $val)
                if (is_array($array2[$key]))
                    $merged[$key] = is_array($merged[$key]) ? Utilities::array_merge_recursive_distinct($merged[$key], $array2[$key]) : $array2[$key];
                else
                    $merged[$key] = $val;
                        
        return $merged;
    }
}