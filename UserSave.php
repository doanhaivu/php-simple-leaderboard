<?php
error_reporting(E_ALL);
require_once 'Model/UserModel.php';

$input = json_decode(file_get_contents('php://input'), true);

$in_userId = $input['UserId'];
$in_data = $input['Data'];

if(!RequestValidator::isValidNumeric($in_userId) || !is_array($in_data))
{
    ResponseError::sendMsg('Params format invalid');
    exit;
}

$userData = UserModel::getById($in_userId);
$ret = array();

if (!is_object($userData))
{
    $userData = new UserModel($in_userId);
    $userData->setData($in_data);
}
else
{
    $userData->updateData($in_data);
}

$userData->save();

$ret['Success'] = true;

Response::sendMsg($ret);