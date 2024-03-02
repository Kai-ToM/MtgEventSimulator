<?php
include 'player.php';

class Game
{
    const MAX_WINS = 7;
    const MAX_LOSSES = 3;
    protected $players_winrate = [];

    protected function getPlayer()
    {
        return new Player();
    }

    protected function saveWinRate(Player $player)
    {
        $this->players_winrate[] = $player->getWins() / ($player->getWins() + $player->getLosses());
    }

    public function playGames($times)
    {
        $player1 = $this->getPlayer();
        $player2 = $this->getPlayer();

        for ($i = 0; $i < $times; $i++) {
            $this->duel($player1, $player2);

            if ($this->isGameFinished($player1)) {
                $this->saveWinRate($player1);
                $player1 = $this->getPlayer();
            }
            if ($this->isGameFinished($player2)) {
                $this->saveWinRate($player2);
                $player2 = $this->getPlayer();
            }
        }
    }

    protected function duel(Player $player1, Player $player2)
    {
        do {
            $is_player1_win = $player1->getResult();
            $is_player2_win = $player2->getResult();
        }
        while ($is_player1_win !== $is_player2_win);

        if ($is_player1_win) {
            $player1->addWin();
            $player2->addLose();
        } else {
            $player2->addWin();
            $player1->addLose();
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