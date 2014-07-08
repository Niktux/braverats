<?php

namespace Niktux\Braverats\Tournament;

use Niktux\Braverats\Player;
use Niktux\Braverats\Game;
use Niktux\Braverats\IdentifiedPlayer;

class Match
{
    private
        $homeGoals,
        $awayGoals,
        $home,
        $away;
    
    public function __construct(Player $home, Player $away)
    {
        $this->home = $home;
        $this->away = $away;
        
        $this->homeGoals = null;
        $this->awayGoals = null;
    }
    
    public function __toString()
    {
        return sprintf(
            "%18s    <goal>%d</goal> - <goal>%d</goal>    %-18s",
            $this->home->getName(),
            $this->homeGoals,
            $this->awayGoals,
            $this->away->getName()
        );
    }
    
    public function play()
    {
        $g = new Game(clone $this->home, clone $this->away);
        $g->disableLog()
          ->resolve();
        
        list($this->homeGoals, $this->awayGoals) = $g->getScore();
    }
    
    public function getHomeGoals()
    {
        return $this->homeGoals;
    }
     
    public function getAwayGoals()
    {
        return $this->awayGoals;
    } 
    
    /**
     * @return IdentifiedPlayer
     */
    public function getHome()
    {
        return $this->home;
    }
    
    /**
     * @return IdentifiedPlayer
     */
    public function getAway()
    {
        return $this->away;
    }
}