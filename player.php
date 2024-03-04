<?php

class Player
{
    protected $wins = 0;
    protected $losses = 0;

    protected $results = [];

    protected $strengs;
    protected $strengs_range_max;

    public function __construct($strengs, $strengs_range_max)
    {
        $this->strengs = $strengs;
        $this->strengs_range_max = $strengs_range_max;
    }

    public function addWin(int $opprnent_strengs)
    {
        $this->results[] = [
            'result' => 'win',
            'opprnent_strengs' => $opprnent_strengs,
        ];
    }

    public function addLose(int $opprnent_strengs)
    {
        $this->results[] = [
            'result' => 'lose',
            'opprnent_strengs' => $opprnent_strengs,
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
        return rand(1, $this->strengs_range_max) < $this->strengs;
    }

    public function getResults()
    {
        return $this->results;
    }

    public function getStrengs()
    {
        return $this->strengs;
    }
}
