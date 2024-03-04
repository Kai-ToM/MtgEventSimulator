<?php

class Player
{
    protected $wins = 0;
    protected $losses = 0;

    protected $results = [];

    protected $expected_winrate;
    protected $winrate_range_max;

    public function __construct($expected_winrate, $winrate_range_max)
    {
        $this->expected_winrate = $expected_winrate;
        $this->winrate_range_max = $winrate_range_max;
    }

    public function addWin(int $opprnent_expected_winrate)
    {
        $this->results[] = [
            'result' => 'win',
            'opprnent_expected_winrate' => $opprnent_expected_winrate,
        ];
    }

    public function addLose(int $opprnent_expected_winrate)
    {
        $this->results[] = [
            'result' => 'lose',
            'opprnent_expected_winrate' => $opprnent_expected_winrate,
        ];
    }

    public function getWins()
    {
        return count(array_filter($this->results, function ($result) {
            return $result['result'] == 'win';
        }));
    }

    public function getLosses()
    {
        return count(array_filter($this->results, function ($result) {
            return $result['result'] == 'lose';
        }));
    }

    public function getPower()
    {
        return rand(1, $this->winrate_range_max) > $this->expected_winrate;
    }

    public function getResults()
    {
        return $this->results;
    }

    public function getExpectedWinRate()
    {
        return $this->expected_winrate;
    }
}
