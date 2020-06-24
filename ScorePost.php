<?php
error_reporting(E_ALL);
require_once 'Model/LeaderboardModel.php';

$input = json_decode(file_get_contents('php://input'), true);

$in_userId = $input['UserId'];
$in_leaderboardId = $input['LeaderboardId'];
$in_score = $input['Score'];

if(!RequestValidator::isValidNumeric($in_userId) || !RequestValidator::isValidNumeric($in_leaderboardId) || !RequestValidator::isValidNumeric($in_score))
{
    ResponseError::sendMsg('Params should be numeric');
    exit;
}

$leaderboardData = LeaderboardModel::getById($in_leaderboardId);
if (!is_object($leaderboardData))
{
    $leaderboardData = new LeaderboardModel($in_leaderboardId);
}

if ($leaderboardData->updateHighScore($in_userId, $in_score))
{
    $leaderboardData->sortLeaderboard();
    $leaderboardData->save();
}

$ret = array();
$ret['UserId'] = $in_userId;
$ret['LeaderboardId'] = $in_leaderboardId;
$ret['Score'] = $leaderboardData->getUserScore($in_userId);
$ret['Rank'] = $leaderboardData->getUserRank($in_userId);

Response::sendMsg($ret);