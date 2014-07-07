<?php

namespace Niktux\Braverats\Players;

use Niktux\Braverats\Player;

class Dumb implements Player
{
    private
        $cards;
    
    public function __construct()
    {
        $this->cards = [0, 1, 2, 3, 4, 5, 6, 7];
    }
    
	public function play($opponentCard = null)
	{
	    shuffle($this->cards);
	    
	    return array_shift($this->cards);
	}

	public function getName()
	{
	    return 'Randumb';
	}
	
	public function opponentHasPlayed($card)
	{
	}
	
	public function setBonuses($myBonus, $opponentBonus)
	{
	}
}