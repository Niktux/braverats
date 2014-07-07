<?php

namespace Niktux\Braverats\Players;

use Niktux\Braverats\Player;

class Determinist implements Player
{
    private
        $plays;
    
    public function __construct(array $plays)
    {
        $this->plays = $plays;
    }
    
	public function play($opponentCard = null)
	{
	    return array_shift($this->plays);
	}

	public function getName()
	{
	    return 'Determinist';
	}
	
	public function opponentHasPlayed($card)
	{
	}
	
	public function setBonuses($myBonus, $opponentBonus)
	{
	}
}