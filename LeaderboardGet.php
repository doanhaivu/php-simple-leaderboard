<?php
error_reporting(E_ALL);
require_once 'Model/LeaderboardModel.php';

$input = json_decode(file_get_contents('php://input'), true);

$in_userId = $input['UserId'];
$in_leaderboardId = $input['LeaderboardId'];
$in_offset = $input['Offset'];
$in_limit = $input['Limit'];

if(!RequestValidator::isValidNumeric($in_userId) || !RequestValidator::isValidNumeric($in_leaderboardId) 
    || !RequestValidator::isValidNumeric($in_offset)
    || !RequestValidator::isValidNumeric($in_limit))
{
    ResponseError::sendMsg('Params should be numeric');
    exit;
}

$leaderboardData = LeaderboardModel::getById($in_leaderboardId);
if (!is_object($leaderboardData))
{
    $leaderboardData = new LeaderboardModel($in_leaderboardId);
    $leaderboardData->save();
}


$ret = array();
$ret['UserId'] = $in_userId;
$ret['LeaderboardId'] = $in_leaderboardId;
$ret['Score'] = $leaderboardData->getUserScore($in_userId);
$ret['Rank'] = $leaderboardData->getUserRank($in_userId);

$arrKeys = array_keys($leaderboardData->getScoreData());

$count = count($arrKeys);
$in_offset = $count - $in_offset;//use offset as array index
$in_limit = $in_offset - $in_limit;//use limit as array index

if ($in_limit >= 0 && $in_offset < $count && $in_limit<=$in_offset)
{
    for ($i = $in_offset ; $i > $in_limit; $i--)
    {
        $entry = array();
        $entry['UserId'] = $arrKeys[$i];
        $entry['Score'] = $leaderboardData->getUserScore($entry['UserId']);
        $entry['Rank'] = $count-$i;
        $ret['Entries'][] = $entry;
    }
}

Response::sendMsg($ret);