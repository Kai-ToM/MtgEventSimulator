<?php
include 'playerGetter.php';

class Game
{
    const MAX_WINS = 7;
    const MAX_LOSSES = 3;

    protected $players_winrate = [];

    protected $player_getter;
    
    public function __construct()
    {
        $this->player_getter = new PlayerGetter();
    }

    protected function saveWinRate(Player $player)
    {
        $this->players_winrate[] = $player->getWins() / ($player->getWins() + $player->getLosses());
    }

    public function playGames($times)
    {
        $player1 = $this->player_getter->get();
        
        for ($i = 0; $i < $times; $i++) {
            $player2 = $this->player_getter->get();
            $this->duel($player1, $player2);

            if ($this->isGameFinished($player1)) {
                $this->saveWinRate($player1);
                $player1 = $this->player_getter->get();
            }
        }
    }

    protected function duel(Player $player1, Player $player2)
    {
        do {
            $is_player1_win = $player1->getPower();
            $is_player2_win = $player2->getPower();
        }
        while ($is_player1_win !== $is_player2_win);

        if ($is_player1_win) {
            $player1->addWin($player2->getExpectedWinRate());
        } else {
            $player1->addLose($player2->getExpectedWinRate());
        }
    }

    protected function isGameFinished($player)
    {
        return $player->getWins() === self::MAX_WINS || $player->getLosses() === self::MAX_LOSSES;
    }

    public function getWinrate()
    {
        return $this->players_winrate;
    }
}
