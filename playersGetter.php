<?php
include 'player.php';

class PlayersGetter
{
    const WINTATE_CONFIG = [
        'range' => [
            'min'  => 1,
            'max' => 100,
        ],
        'edit' => [
            'quantity' => 15,
            'bias' => 10,
        ],
    ];

    public function getMass(int $count, int $dummy):array
    {
        if (($count % 100) !== 0) {
            throw new Exception("プレイヤー数は100人ずつ設定してください");
        }
        $players = [];
        for ($i = 0; $i < $count; $i++) {
            $players[] = new Player($this->getWinrate($count, $i), self::WINTATE_CONFIG['range']['max']);
        }
        shuffle($players);
        $dummy = $this->getDummy($dummy);
        return array_merge($players, $dummy);
    }

    protected function getWinrate($count, $i): int
    {
        $base_winrate = self::WINTATE_CONFIG['range']['max'] / 2;
        if ((self::WINTATE_CONFIG['edit']['quantity'] * 2 * $count / self::WINTATE_CONFIG['range']['max']) < $i) {
            return $base_winrate;
        } elseif ((self::WINTATE_CONFIG['edit']['quantity'] * $count / self::WINTATE_CONFIG['range']['max']) > $i) {
            return $base_winrate - self::WINTATE_CONFIG['edit']['bias'];
        } else {
            return $base_winrate + self::WINTATE_CONFIG['edit']['bias'];
        }
    }

    protected function getDummy(int $count)
    {
        $dummy = [];
        for ($i = 0; $i < $count; $i++) {
            $dummy[] = new Player(self::WINTATE_CONFIG['range']['max']/2 , self::WINTATE_CONFIG['range']['max']);
        }
        return $dummy;
    }
}