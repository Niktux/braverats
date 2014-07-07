<?php

namespace Niktux\Braverats;

class Resolver
{
    const
        DRAW = 0,
        WIN = 5;
    
    private
        $card1, $card2,
        $bonus1, $bonus2,
        $cancelPower,
        $compareClosure;
    
    public function __construct()
    {
        $this->card1 = null;
        $this->card2 = null;
        
        $this->bonus1 = false;
        $this->bonus2 = false;
        
        $this->cancelPower = null;
        $this->compareClosure = null;
    }
    
    public function setCard1($card)
    {
        $this->card1 = (int) $card;

        return $this;
    }
    
    public function setCard2($card)
    {
        $this->card2 = (int) $card;
        
        return $this;
    }
    
    public function setBonus1($bonus = true)
    {
        $this->bonus1 = $bonus;
        
        return $this;
    }
    
    public function setBonus2($bonus = true)
    {
        $this->bonus2 = $bonus;
        
        return $this;
    }
    
    public function getBonus1()
    {
        return $this->bonus1 ? 2 : 0;
    }
    
    public function getBonus2()
    {
        return $this->bonus2 ? 2 : 0;
    }
    
    /**
     * @return int 0 draw, >0 player1, <0 player2
     */
    public function resolve()
    {
        $this->initResolve();
        
        $this->checkCard($this->card1);    
        $this->checkCard($this->card2);

        return $this->compareCards();
    }
    
    private function initResolve()
    {
        $this->cancelPower = false;
        $this->compareClosure = function($c1, $c2) {
            return $c1 - $c2;    
        };
    }
    
    public function cancelPower()
    {
        return $this->cancelPower;
    }
    
    private function checkCard($card)
    {
        if($card === null || ! is_numeric($card) || $card < 0 || $card > 7)
        {
            throw new \InvalidArgumentException("$card [$card] is not valid");
        }
    }
    
    private function compareCards()
    {
        try
        {
            $this->checkMusicien();
            $this->checkPrinceVsPrincess();
            $this->checkPrince();
            $this->checkMagicien();
            
            if($this->cancelPower === false)
            {
                $this->checkAssassin();
            }
        }
        catch(ResolvedException $e)
        {
            return $e->result;
        }
        
        $compare = $this->compareClosure;
        $result = $compare(
            $this->card1 + $this->getBonus1(), 
            $this->card2 + $this->getBonus2()
        );
        
        return $this->applyAmbassadeur( 
            $this->normalizeResult($result)
        );
    }

    private function applyAmbassadeur($result)
    {
        if($this->cancelPower === true)
        {
            return $result;
        }
        
        if($result > 0 && $this->card1 === Card::AMBASSADEUR_4
        || $result < 0 && $this->card2 === Card::AMBASSADEUR_4)
        {
            $result *= 2;
        }
        
        return $result;
    }
    
    private function hasBeenPlayed($card)
    {
        return $this->card1 === $card || $this->card2 === $card;
    }
    
    private function checkMusicien()
    {
        if($this->hasBeenPlayed(Card::MUSICIEN_0))
        {
            if(! $this->hasBeenPlayed(Card::MAGICIEN_5))
            {
                throw new ResolvedException(self::DRAW);            
            }
        }
    }
    
    private function checkPrinceVsPrincess()
    {
        if($this->hasBeenPlayed(Card::PRINCESSE_1) && $this->hasBeenPlayed(Card::PRINCE_7))
        {
            $player = $this->card1 === Card::PRINCESSE_1 ? 1 : -1;
            
            throw new ResolvedException(self::WIN * $player);
        }
    }
    
    private function checkPrince()
    {
        $this->checkPrinceForPlayer($this->card1, $this->card2);
        $this->checkPrinceForPlayer($this->card2, $this->card1, -1);
    }
    
    private function checkPrinceForPlayer($card, $cardOpponent, $result = 1)
    {
        if($card === Card::PRINCE_7)
        {
            // PRINCESS_1 & MUSICIEN_0 has already been checked
            if($cardOpponent !== Card::PRINCE_7)
            {
                throw new ResolvedException($result);
            }
        }
    }
    
    private function checkMagicien()
    {
        if($this->hasBeenPlayed(Card::MAGICIEN_5))
        {
            $this->cancelPower = true;
        }
    }
    
    private function checkAssassin()
    {
        if($this->hasBeenPlayed(Card::ASSASSIN_3))
        { 
            $this->compareClosure = function($c1, $c2) {
                return $c2 - $c1;    
            };
        }
    }
    
    private function normalizeResult($result)
    {
        if($result != 0)
        {
           $result /= abs($result); 
        }
        
        return $result;
    }
}