<?php
include 'game.php';

$game = new Game();
$game->playGames(10000);
$winrate = $game->getWinrate();
file_put_contents('./result.csv', implode(PHP_EOL, $winrate));