<?php

namespace Niktux\Braverats;

final class Game
{
    private
        $player1,
        $player2,
        $cards,
        $points,
        $players,
        $bonus,
        $waitingDrawRounds;
    
    public function __construct(Player $p1, Player $p2)
    {
        $this->player1 = $p1 = new IdentifiedPlayer($p1);
        $this->player2 = $p2 = new IdentifiedPlayer($p2);
        
        $cards = [0, 1, 2, 3, 4, 5, 6, 7];
        
        $this->cards = array(
        	$p1->getId() => $cards,
            $p2->getId() => $cards,  
        );
        
        $this->points = array(
        	$p1->getId() => 0,
        	$p2->getId() => 0,
        );
        
        $this->players = array(
        	$p1->getId() => $p1,
        	$p2->getId() => $p2,
        );
        
        $this->bonus = array(
        	$p1->getId() => 0,
        	$p2->getId() => 0,
        );
    }
    
    public function resolve()
    {
        $round = 0;
        $this->waitingDrawRounds = 0;
        
        while($round < 8 && $this->getWinner() === null)
        {
            $round++;
            $this->log("= Round $round ==================================");
            
            $card1 = $this->play($this->player1);
            $card2 = $this->play($this->player2);
            
            $this->checkCardIsAllowed($this->player1, $card1);
            $this->checkCardIsAllowed($this->player2, $card2);
            
            $this->updateAfterRound($card1, $card2);
        }
    }
    
    private function getWinner()
    {
        foreach($this->points as $id => $point)
        {
            if($point >= 4)
            {
                return $this->players[$id];
            }            
        }
        
        return null;
    }
    
    private function log($message)
    {
        echo "$message\n";
    }
    
    private function play(Player $p)
    {
        $card = $p->play();
        
        $this->log(sprintf(
            "Player %s plays card #%d",
            $p->getName(),
            $card
        ));
        
        return $card;
    }
    
    private function checkCardIsAllowed(IdentifiedPlayer $player, $card)
    {
        $remainingCards = $this->cards[$player->getId()];
        
        if(! in_array($card, $remainingCards))
        {
            throw new \RuntimeException($player->getName() . " plays discarded card");
        }
    }
    
    private function updateAfterRound($card1, $card2)
    {
        $r = new Resolver();
        
        $result = $r->setCard1($card1)
            ->setCard2($card2)
            ->setBonus1($this->bonus[$this->player1->getId()])
            ->setBonus2($this->bonus[$this->player2->getId()])
            ->resolve();
        
        $this->clearBonus();
        $winnerId = $this->findWinner($result);
        
        if($winnerId !== null)
        {
            $this->points[$winnerId] += abs($result) + $this->waitingDrawRounds;
            $this->waitingDrawRounds = 0;
        }
        else
        {
            $this->waitingDrawRounds++;
        }
        
        $this->printScore();
        
        if($r->cancelPower() === false)
        {
            $this->applyGeneral($this->player1, $card1);    
            $this->applyGeneral($this->player2, $card2);    
        }
    }
    
    private function findWinner($result)
    {
        $winnerId = null;
        
        if($result > 0)
        {
            $winnerId = $this->player1->getId();
        }
        elseif($result < 0)
        {
            $winnerId = $this->player2->getId();
        } 

        return $winnerId;
    }
    
    private function applyGeneral(IdentifiedPlayer $p, $card)
    {
        if($card === Card::GENERAL_6)
        {
            $this->bonus[$p->getId()] = 2;   
        }
    }
    
    private function printScore()
    {
        echo sprintf(
        	"%s %d - %d %s\n",
            $this->player1->getName(),
            $this->points[$this->player1->getId()],                
            $this->points[$this->player2->getId()],                
            $this->player2->getName()
        );
    }
    
    private function clearBonus()
    {
        $this->bonus[$this->player1->getId()] = 0;
        $this->bonus[$this->player2->getId()] = 0;
    }
}