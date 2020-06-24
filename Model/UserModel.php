<?php
require_once (__DIR__.'/../Lib/DataModel.php');

class UserModel extends DataModel
{
    private $data;
    
    public function __construct($userId)
    {
        $this->data = array();
        parent :: __construct($userId) ;
    }
    
    public static function getById($userId)
    {
        return DataModel::get($userId,'UserModel');
    }
    
    public function updateData($in_data)
    {
        $this->data = Utilities::array_merge_recursive_distinct($this->data, $in_data);
    }
    
    public function getData()
    {
        return $this->data;
    }
    
    public function setData($in_data)
    {
        $this->data = $in_data;
    }
    
}