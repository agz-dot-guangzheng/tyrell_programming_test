<?php 
class deck {
	private $_deck, $_players, $_patterns, $_cards;
	
	function __construct() {
		$_deck = null;
		$this->_patterns = ['S','H','D','C'];
		$this->_cards = ['A', '2', '3', '4', '5', '6', '7', '8', '9', 'X', 'J', 'Q', 'K'];
		foreach ($this->_patterns as $flower) {
			foreach ($this->_cards as $card) {
				$this->_deck[] = $flower."-".$card;
			}
		}
		
	}
	
	public function getDeck() {
		
		return $this->_deck;
	}
	
	public function shuffleDeck() {
		try {
			if (count($this->_deck) > 0) {
				$old_deck = $this->_deck;
				$new_deck = null;
				$deck_length = count($old_deck)-1;
				while ($deck_length >= 0) {
					$rand = rand(0,$deck_length);
					$new_deck[] = $old_deck[$rand];
					unset($old_deck[$rand]);
					$old_deck = array_values($old_deck);
					$deck_length--;
				}
				$this->_deck = $new_deck;
			} else throw new Exception("Deck is empty!");
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
	public function setPlayers($num_of_players) {
		try {
			if ($num_of_players < 0) throw new Exception("Number of players cannot be less than 0");
			
			$this->_players = $num_of_players;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
	public function getPlayers() {
		return $this->_players;
	}
	
	public function dealCards() {
		$dealt_cards = null;
		try {
			if ($this->_players < 0) throw new Exception("Players cannot be less than 0!");
			if (count($this->_deck) <= 0) throw new Exception("Deck not generated");
            if (count($this->_deck) % $this->_players != 0) throw new Exception("Irregularity occured");
			
			$dealt_cards = array_fill(0, $this->_players, array());
			$dealing_index = 0;
			$current_deck = $this->_deck;
			foreach ($current_deck as $k => $cards) {
				$dealt_cards[$dealing_index][] = $cards;
				$dealing_index = ($dealing_index + 1) % $this->_players;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		return $dealt_cards;
	}
}

