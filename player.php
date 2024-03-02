<?php

class Player
{
    protected $wins = 0;
    protected $losses = 0;

    protected $expected_winrate;
    protected $winrate_range_max;

    public function __construct($expected_winrate, $winrate_range_max)
    {
        $this->expected_winrate = $expected_winrate;
        $this->winrate_range_max = $winrate_range_max;
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
        return rand(1, $this->winrate_range_max) > $this->expected_winrate;
    }

    protected function getExpectedWinRate()
    {
        return $this->expected_winrate;
    }
}
