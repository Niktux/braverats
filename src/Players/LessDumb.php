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
        $cards;
    
    public function __construct()
    {
        $this->cards = [0, 1, 2, 3, 4, 5, 6, 7];
    }
    
	protected function choseCard($opponentCard = null)
	{
	   if($opponentCard === null)
	   {
    	   return $this->randomPlay();
	   }
	   
	   $r = new Resolver();
	   $r->setBonus1($this->bonus)
	     ->setBonus2($this->opponentBonus)
	     ->setCard2($opponentCard);
	   
	   $max = Resolver::WIN * -1;
	   
	   foreach($this->cards as $card)
	   {
	       $resolv = clone $r;
	       $result = $r->setCard1($card)->resolve();

	       if($result >= $max)
	       {
	           $max = $card;
	       }
	   }

	   return $max;
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
	    return 'LessDumb';
	}
}