<?php
require_once "deck.php";

$answer = readline("Please enter number of players to continue: ");
$num_player = trim($answer);
if (isset($num_player) && !empty($num_player)) {

    $play = new deck();
    // print_r($play->getDeck());
    $play->shuffleDeck();
    // print_r($play->getDeck());
    $play->setPlayers(104);
    // print_r($play->getPlayers());
    $game = $play->dealCards();
    print_r($game);
// }
