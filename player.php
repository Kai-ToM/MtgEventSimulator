<?php

class Player
{
    protected $wins = 0;
    protected $losses = 0;

    protected $expected_win_rate;

    public function __construct($expected_win_rate = 50)
    {
        $this->expected_win_rate = $expected_win_rate;
    }

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

    public function getResult()
    {
        return rand(1, 100) > $this->expected_win_rate;
    }
}
