<?php 
class deck {
	private $_deck, $_players, $_patterns, $_cards, $_irregularity;
	
	function __construct() {
		$_deck = null;
		$this->_irregularity = false;
		// Deck patterns and number of cards, can be customized for other playing cards
		$this->_patterns = ['S','H','D','C'];
		$this->_cards = ['A', '2', '3', '4', '5', '6', '7', '8', '9', 'X', 'J', 'Q', 'K'];
		// Generate deck
		foreach ($this->_patterns as $flower) {
			foreach ($this->_cards as $card) {
				$this->_deck[] = $flower."-".$card;
			}
		}
		
	}
	
	public function getDeck() {
		
		return $this->_deck;
	}
	
	public function shuffleDeck($shuffle_times = 1) {
		try {
			// Shuffle deck x times based on param received
			for( $i = 0; $i < $shuffle_times; $i++) {
				if (count($this->_deck) > 0) {
					$old_deck = $this->_deck;
					$new_deck = null;
					$deck_length = count($old_deck)-1;
					while ($deck_length >= 0) {
						// Generate random index to get from current deck
						$rand = rand(0,$deck_length);
						$new_deck[] = $old_deck[$rand];
						// Remove shuffled card from the deck
						unset($old_deck[$rand]);
						// Reset index
						$old_deck = array_values($old_deck);
						// Reduce random range
						$deck_length--;
					}
					// Assign shuffled deck as new deck
					$this->_deck = $new_deck;
				} else throw new Exception("Deck is empty!");
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	
	public function setPlayers($num_of_players) {
		try {
			// Second check for invalid character for number of players
			if (is_integer($num_of_players) && $num_of_players <= 0) throw new Exception("Number of players cannot be less than 0");
			
			$this->_players = $num_of_players;
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	
	public function getPlayers() {
		return $this->_players;
	}
	
	public function dealCards() {
		$dealt_cards = null;
		try {
			// Some exception handling
			if ($this->_players < 0) throw new Exception("Players cannot be less than 0!");
			if (count($this->_deck) <= 0) throw new Exception("Deck not generated");
			// Irregularity might occur here since the divisor might cause players to have uneven number of cards
            if (count($this->_deck) % $this->_players != 0) $this->_irregularity = true;
			
			// Create empty arrays for all players 
			$dealt_cards = array_fill(0, $this->_players, array());
			$dealing_index = 0;
			$current_deck = $this->_deck;
			// Deal card accordingly from first card
			foreach ($current_deck as $k => $cards) {
				$dealt_cards[$dealing_index][] = $cards;
				$dealing_index = ($dealing_index + 1) % $this->_players;
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
		return $dealt_cards;
	}

	public function getIrregularity() {
		return $this->_irregularity;
	}
}

