<?php

namespace Niktux\Braverats\Players;

use Niktux\Braverats\Player;
use Niktux\Braverats\Utils\Cards;
use Niktux\Braverats\Utils\Bonus;

class StrongerFirst implements Player
{
    use Cards;
    use Bonus;
    
    public function __construct()
    {
        $this->initCards();
    }
    
	protected function choseCard($opponentCard = null)
	{
	    return end($this->cards);
	}

	public function getName()
	{
	    return 'StrongerFirst';
	}
}