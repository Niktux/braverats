<?php

namespace Niktux\Braverats\Players;

use Niktux\Braverats\Player;
use Niktux\Braverats\Utils\Cards;
use Niktux\Braverats\Utils\Bonus;
use Niktux\Braverats\Resolver;
use Niktux\Braverats\Card;

class LessDumb implements Player
{
    use Cards;
    use Bonus;
    
    private
        $name,
        $cards;
    
    public function __construct($name = null)
    {
        $this->name = $name;
        $this->cards = [0, 1, 2, 3, 4, 5, 6, 7];
    }
    
	protected function choseCard($opponentCard = null)
	{
	   if($opponentCard === null)
	   {
    	   return $this->randomPlay();
	   }
	   
	   $max = Resolver::WIN * -1;
	   $maxCard = -1;
	   
	   foreach($this->cards as $card)
	   {
	       $result = $this->resolve($card, $opponentCard);

	       if($result > $max)
	       {
	           $max = $result;
	           $maxCard = $card;
	       }
	   }

	   return $maxCard;
	}
	
	private function randomPlay()
	{
	    if(isset($this->cards[Card::ESPION_2]))
	    {
	        return Card::ESPION_2;
	    }
	    
	    $indexes = array_keys($this->cards);
	    shuffle($indexes);
	    
	    return $this->cards[array_shift($indexes)];
	}

	public function getName()
	{
	    return $this->name ?: 'LessDumb';
	}
}