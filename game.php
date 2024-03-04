<?php
include 'playersGetter.php';

class Game
{
    const MAX_WINS = 7;
    const MAX_LOSSES = 3;

    protected $saved_players = [];

    protected $players_getter;
    
    public function __construct()
    {
        $this->players_getter = new PlayersGetter();
    }

    protected function savePlayer(Player $player)
    {
        $this->saved_players[] = $player;
    }

    public function playGames($times)
    {
        $players = $this->players_getter->getMass($times, 10);
        foreach($players as $player1_key =>$player1) {
            $i = 1;
            while (!$this->isGameFinished($player1)) {
                $player2 = $players[$player1_key + $i];
                if (!$this->isGameFinished($player2)) {
                    $this->duel($player1, $player2);
                }
                $i++;
            }
            if ($player1_key > $times) {
                break;
            }
        }
        return array_slice($players, 0, $times);
    }

    protected function duel(Player $player1, Player $player2)
    {
        do {
            $is_player1_win = $player1->getPower();
            $is_player2_win = $player2->getPower();
        }
        while ($is_player1_win === $is_player2_win);

        if ($is_player1_win) {
            $player1->addWin($player2->getExpectedWinRate());
            $player2->addLose($player1->getExpectedWinRate());
        } else {
            $player2->addWin($player1->getExpectedWinRate());
            $player1->addLose($player2->getExpectedWinRate());
        }
    }

    protected function isGameFinished($player)
    {
        return $player->getWins() === self::MAX_WINS || $player->getLosses() === self::MAX_LOSSES;
    }

    public function getSavedPlayers()
    {
        return $this->saved_players;
    }
}
