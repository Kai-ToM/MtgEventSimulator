<?php
include 'player.php';

class PlayerGetter
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

    public function get()
    {
        $expected_winrate = $this->getWinrate();
        return new Player($expected_winrate, self::WINTATE_CONFIG['range']['max']);
    }

    protected function getWinrate()
    {
        $seed = rand(...self::WINTATE_CONFIG['range']);
        $base_winrate = (int)(self::WINTATE_CONFIG['range']['max'] / 2);
        $winrate_edit = self::WINTATE_CONFIG['edit'];

        if ($seed > (self::WINTATE_CONFIG['range']['max'] - $winrate_edit['quantity'])) {
            $winrate = $base_winrate + $winrate_edit['bias'];
        } elseif ($seed < (self::WINTATE_CONFIG['range']['min'] + $winrate_edit['quantity'])) {
            $winrate = $base_winrate - $winrate_edit['bias'];
        } else {
            $winrate = $base_winrate;
        }
        echo $winrate . PHP_EOL;
        return $winrate;
    }
}