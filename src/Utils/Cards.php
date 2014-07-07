<?php

namespace Niktux\Braverats\Utils;

trait Cards
{
    private
        $cards;
    
    private function initCards()
    {
        $this->cards = [0, 1, 2, 3, 4, 5, 6, 7];
    }
    
    public function play()
    {
        $card = $this->choseCard();
        $this->removeCard($card);
        
        return $card;
    }
    
    private function removeCard($card)
    {
        $index = array_search($card, $this->cards);
        
        if($index === false)
        {
            throw new \RuntimeException("Cannot remove card $card");
        }
        
        unset($this->cards[$index]);
    }
    
    abstract protected function choseCard();
}