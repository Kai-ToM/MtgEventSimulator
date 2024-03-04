<?php
include 'game.php';

$game = new Game();
$players = $game->playGames(10000);

$file = fopen('./player_result.csv', 'w');
foreach ($players as $player) {
    $data = [
        $player->getStrengs(), 
        $player->getWins(),
        $player->getLosses(),
        $player->getWins() . '-' . $player->getLosses(),
        $player->getWins() / ($player->getWins() + $player->getLosses())
    ];
    fputcsv($file, $data);
}

$file = fopen('./duel_result.csv', 'w');

$cnt = 0;
$hoge = 0;
foreach ($players as $player) {
    foreach ($player->getResults() as $result) {
        $cnt++;
        $data = [
            $fuga = $player->getStrengs(),
            $result['result'],
        ];
        fputcsv($file, $data);
        $hoge += $fuga;
    }
}
echo $hoge / $cnt . PHP_EOL;

fclose($file);
