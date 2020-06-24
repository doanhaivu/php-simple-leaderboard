<?php
error_reporting(E_ALL);
require_once 'Model/UserTransactionModel.php';

$input = json_decode(file_get_contents('php://input'), true);

$in_transactionId = $input['TransactionId'];
$in_userId = $input['UserId'];
$in_currencyAmount = $input['CurrencyAmount'];
$in_verifier = $input['Verifier'];

if(!RequestValidator::isValidNumeric($in_userId) || !RequestValidator::isValidNumeric($in_transactionId) || !RequestValidator::isValidNumeric($in_currencyAmount)) 
{
    ResponseError::sendMsg('Params should be numeric');
    exit;
}

global $CONFIG;
$hash = hash_hmac("sha1", $CONFIG['secret'].$in_transactionId.$in_userId.$in_currencyAmount, $CONFIG['secret']);
if ($hash != $in_verifier) 
{
    ResponseError::sendMsg('Invalid Verifier');
    exit;
}

$transactionData = UserTransactionModel::getById($in_userId);
if (!is_object($transactionData))
{
    $transactionData = new UserTransactionModel($in_userId);
}

if ($transactionData->isTransactionExist($in_transactionId))
{
    ResponseError::sendMsg('Duplicate Transaction');
    exit;
}

$transactionData->addNewTransaction($in_transactionId, $in_currencyAmount);
$transactionData->save();

$ret = array();
$ret['Success'] = true;
Response::sendMsg($ret);

        