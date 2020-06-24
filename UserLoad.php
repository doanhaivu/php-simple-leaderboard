<?php
error_reporting(E_ALL);
require_once 'Model/UserModel.php';

$input = json_decode(file_get_contents('php://input'), true);

$in_userId = $input['UserId'];

if(!RequestValidator::isValidNumeric($in_userId))
{
    ResponseError::sendMsg('Params should be numeric');
    exit;
}

$userData = UserModel::getById($in_userId);
if (!is_object($userData))
{
    $userData = new UserModel($in_userId);
}

$ret = $userData->getData();

Response::sendMsg($ret);