<?php

namespace Niktux\Braverats\Utils;

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
}