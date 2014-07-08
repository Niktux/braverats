<?php

namespace Niktux\Braverats\Tournament;

use Niktux\Braverats\IdentifiedPlayer;
use Niktux\Braverats\Player;

class League
{
    const
        EXEMPT = 'exempt';
    
    private 
        $players,
        $matches;
    
    public function __construct(array $players)
    {
        $this->players = array();
        
        foreach($players as $player)
        {
            if($player instanceof Player)
            {
                $this->players[] = new IdentifiedPlayer($player);
            }
        }
        
        $this->initialize();
    }
    
    private function initialize()
    {
        $this->matches = array();
        
        $rounds = $this->roundRobin();
        
        foreach($rounds as $round => $roundMatches)
        {
            $matches = array();
            
            foreach($roundMatches as $players)
            {
                list($home, $away) = $players;
                
                if($home !== self::EXEMPT && $away !== self::EXEMPT)
                {
                    $matches[] = new Match($this->players[$home], $this->players[$away]);
                } 
            }
            
            $this->matches[$round] = $matches; 
        }
    }
    
    public function show()
    {
        foreach($this->matches as $round => $roundMatches)
        {
            echo "===========================================================\n";
            echo "Round " . ($round+1) . PHP_EOL;
            echo "===========================================================\n";
            
            foreach($roundMatches as $match)
            {
                echo $match . PHP_EOL;
            }
            echo PHP_EOL;
        }
    }
    
    public function getMatches()
    {
        return $this->matches;
    }
    
    public function getPlayers()
    {
        return $this->players;
    }
    
    private function roundRobin()
    {
        $players = array_keys($this->players);
        
        if(count($players) % 2 !== 0)
        {
            array_push($players, self::EXEMPT);
        }
    
        $away = array_splice($players, (count($players)/2));
        $home = $players;
        $rounds = array();
    
        $limit = count($home) + count($away) - 1;
        
        for($i = 0 ; $i < $limit ; $i++)
        {
            for($j = 0 ; $j < count($home) ; $j++)
            {
                $rounds[$i][$j] = array($home[$j], $away[$j]);
            }
    
            if(count($home) + count($away) - 1 > 2)
            {
                array_unshift($away, array_shift(array_splice($home, 1, 1)));
                array_push($home, array_pop($away));
            }
        }
    
        return $rounds;
    }
}