<?php

namespace Niktux\Braverats;

interface Player
{
    /**
     * @return int
     */
    public function play($opponentCard = null);
    
    /**
     * @return string
     */
    public function getName();
    
    /**
     * 
     */
    public function opponentHasPlayed($card);

    /**
     * 
     */
    public function setBonuses($myBonus, $opponentBonus);
}