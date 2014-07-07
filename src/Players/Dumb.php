<?php

namespace Niktux\Braverats\Players;

use Niktux\Braverats\Player;

class Dumb implements Player
{
    private
        $cards,
        $name;
    
    public function __construct($name)
    {
        $this->cards = [0, 1, 2, 3, 4, 5, 6, 7];
        $this->name = $name;
    }
    
	public function play()
	{
	    shuffle($this->cards);
	    
	    return array_shift($this->cards);
	}

	public function getName()
	{
	    return $this->name;
	}
}