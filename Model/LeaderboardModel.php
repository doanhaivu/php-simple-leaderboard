<?php
require_once (__DIR__.'/../Lib/DataModel.php');

class LeaderboardModel extends DataModel
{
    private $scoreArr;//userid mapped to score for each leaderboard
    
    public function __construct($leaderboardId)
    {
        $this->scoreArr = array();
        parent :: __construct($leaderboardId) ;
    }
    
    public static function getById($leaderboardId)
    {
        return DataModel::get($leaderboardId,'LeaderboardModel');
    }
    
    public function updateHighScore($userId, $score)
    {
        if(isset($this->scoreArr[$userId]))
        {
            if ($score > $this->scoreArr[$userId])
            {
                $this->scoreArr[$userId] = $score;
                return true;
            }
            else 
                return false;
        }
        else 
        {
            $this->scoreArr[$userId] = $score;
            return true;
        }
    }
    
    public function sortLeaderboard()
    {
        asort($this->scoreArr, SORT_NUMERIC);
    }
    
    public function getUserScore($userId)
    {
        if (!isset($this->scoreArr[$userId]))
            return NULL;
        else 
            return $this->scoreArr[$userId];
    }
    
    public function getUserRank($userId)
    {
        $rank = sizeof($this->scoreArr);
        foreach ($this->scoreArr as $key=>$value)
        {
            if ($userId == $key)
            {
                break;
            }
            $rank--;
        }
        if ($rank == 0)
            $rank = NULL;
        return $rank;
    }
    
    public function getScoreData()
    {
        return $this->scoreArr;
    }
}