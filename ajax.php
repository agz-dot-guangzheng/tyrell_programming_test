<?php 
require_once "deck.php";
$return = false;
$action = isset($_POST['action']) && !empty($_POST['action']) ? $_POST['action'] : "";

switch ($action) {
    case "dealCards": 

        $num_player = trim($_POST['num_players']);
        if (isset($num_player) && !empty($num_player)) {

            // constructs deck
            $play = new deck();
            // shuffle deck, can be set to shuffle a fixed number of times, or a random number of times, but a limit should be implemented if random numebr of times is going to implement to prevent heavy loops. Sames goes to fixed number of times.
            $play->shuffleDeck(1);
            $play->setPlayers($num_player);
            $game = $play->dealCards();
            
            // checks for irregularity
            if ($play->getIrregularity() == true) {
                $return['irregularity'] = "Irregularity occured";
            }

            $return['response_code'] = 0;
            $return['response_msg'] = "Success";
            $return['data'] = array();

            foreach ($game as $k => $v) {
                $return['data'][$k] = implode(",", $v);
            } 
            

        } else {
            $return['response_code'] = -2;
            $return['response_msg'] = "Invalid number of players";
        }
        break;
    default: 
    break;
}

echo json_encode($return);