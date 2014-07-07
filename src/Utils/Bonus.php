<?php

namespace Niktux\Braverats\Utils;

use Niktux\Braverats\Resolver;

trait Bonus
{
    private
        $bonus = 0,
        $opponentBonus = 0;
	
	public function setBonuses($myBonus, $opponentBonus)
	{
	    $this->bonus = $myBonus;
	    $this->opponentBonus = $opponentBonus;
	}
	
	private function resolve($card, $opponentCard)
	{
	    $r = new Resolver();
	    $r->setBonus1($this->bonus)
	      ->setBonus2($this->opponentBonus)
	      ->setCard1($card)
	      ->setCard2($opponentCard);
	    
	    return $r->resolve();
	}
}