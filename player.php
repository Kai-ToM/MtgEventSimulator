<?php

class Player
{
    protected $wins = 0;
    protected $losses = 0;

    public function addWin()
    {
        $this->wins++;
    }

    public function addLose()
    {
        $this->losses++;
    }

    public function getWins()
    {
        return $this->wins;
    }

    public function getLosses()
    {
        return $this->losses;
    }
}
