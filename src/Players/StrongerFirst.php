<?php

namespace Niktux\Braverats\Players;

use Niktux\Braverats\Player;
use Niktux\Braverats\Utils\Cards;

class StrongerFirst implements Player
{
    use Cards;
    
    private
        $name;
    
    public function __construct($name)
    {
        $this->name = $name;
        $this->initCards();
    }
    
	protected function choseCard()
	{
	    return end($this->cards);
	}

	public function getName()
	{
	    return $this->name;
	}
}