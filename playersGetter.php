<?php
include 'player.php';

class PlayersGetter
{

    const WINTATE_RANGE = [
        'min'  => 1,
        'max' => 100,
    ];

    const STRENGS_EDIT = [
        'quantity' => 15,
        'bias' => 10,
    ];

    public function getMass(int $count, int $dummy):array
    {
        if (($count % 100) !== 0) {
            throw new Exception("プレイヤー数は100人ずつ設定してください");
        }
        $players = [];
        for ($i = 0; $i < $count; $i++) {
            $players[] = new Player($this->getStrengs($count, $i), self::WINTATE_RANGE['max']);
        }
        shuffle($players);
        $dummy = $this->getDummy($dummy);
        return array_merge($players, $dummy);
    }

    protected function getStrengs($count, $i): int
    {
        $base_strengs = self::WINTATE_RANGE['max'] / 2;
        if ((self::STRENGS_EDIT['quantity'] * 2 * $count / self::WINTATE_RANGE['max']) <= $i) {
            return $base_strengs;
        } elseif ((self::STRENGS_EDIT['quantity'] * $count / self::WINTATE_RANGE['max']) > $i) {
            return $base_strengs - self::STRENGS_EDIT['bias'];
        } else {
            return $base_strengs + self::STRENGS_EDIT['bias'];
        }
    }

    protected function getDummy(int $count)
    {
        $dummy = [];
        for ($i = 0; $i < $count; $i++) {
            $dummy[] = new Player(self::WINTATE_RANGE['max']/2 , self::WINTATE_RANGE['max']);
        }
        return $dummy;
    }
}