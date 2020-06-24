<?php
error_reporting(E_ALL);
require_once 'Model/UserTransactionModel.php';

$input = json_decode(file_get_contents('php://input'), true);

$in_userId = $input['UserId'];

if(!RequestValidator::isValidNumeric($in_userId))
{
    ResponseError::sendMsg('Params should be numeric');
    exit;
}

$transactionData = UserTransactionModel::getById($in_userId);
if (!is_object($transactionData))
{
    $transactionData = new UserTransactionModel($in_userId);
}

$ret = array();
$ret['UserId'] = $in_userId;
$ret['TransactionCount'] = sizeof($transactionData->getTransactionList());
$ret['CurrencySum'] = $transactionData->getSum();

Response::sendMsg($ret);