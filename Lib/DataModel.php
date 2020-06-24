<?php
require_once 'DataProvider.php';

class DataModel
{
    protected $userId;
    public function __construct($id)
    {
        $this->userId = $id ;
    }
    
    public function save()
    {
        $keyName = Utilities::getDataKeyName($this->userId, get_class($this));
        return DataProvider::set($keyName, $this);
    }
    
    public static function get($id, $className)
    {
        $keyName = Utilities::getDataKeyName($id, $className);
        return DataProvider::get($keyName);
    }
}