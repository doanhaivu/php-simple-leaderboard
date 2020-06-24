<?php
require_once (__DIR__.'/../Lib/DataModel.php');

class UserTransactionModel extends DataModel
{
    
    private $transactionArr;
    private $sum;
    
    public function __construct($userId)
    {
        $this->transactionArr = array();
        $this->sum = 0;
        parent :: __construct($userId) ;
    }
    
    public static function getById($userId)
    {
        return DataModel::get($userId,'UserTransactionModel');
    }
    
    public function isTransactionExist($in_transId)
    {
        return isset($this->transactionArr[$in_transId]);
    }
    
    public function addNewTransaction($in_transId, $in_amount)
    {
        $this->transactionArr[$in_transId] = $in_amount;
        $this->sum += $in_amount;
    }
    
    public function getTransactionList()
    {
        return $this->transactionArr;
    }
    
    public function getSum()
    {
        return $this->sum;
    }
}