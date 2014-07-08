<?php

namespace Niktux\Braverats\Tournament;

use Niktux\Braverats\IdentifiedPlayer;
use Karma\Display\CliTable;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class PlayableLeague
{
    private
        $league,
        $currentRound,
        $nbRounds,
        $matches,
        $players,
        $output;
    
    public function __construct(League $league)
    {
        $this->league = $league;
        $this->matches = $league->getMatches();
        $this->nbRounds = count($this->matches);
        $this->currentRound = 0;
        $this->players = array();
        $this->initAllRankings();
        
        $this->output = new ConsoleOutput();
        $this->initConsoleStyles();
    }
    
    private function initAllRankings()
    {
        foreach($this->league->getPlayers() as $player)
        {
            $this->players[$player->getId()] = $this->initRanking($player);
        }
    }
    
    private function initConsoleStyles()
    {
        $this->output->getFormatter()->setStyle(
            'leader', 
            new OutputFormatterStyle('green', null, array('bold'))
        );
        
        $this->output->getFormatter()->setStyle(
            'round', 
            new OutputFormatterStyle('cyan', null, array('bold'))
        );
        
        $this->output->getFormatter()->setStyle(
            'roundTitle', 
            new OutputFormatterStyle('cyan', null, array())
        );
        
        $this->output->getFormatter()->setStyle(
            'goal', 
            new OutputFormatterStyle('white', null, array('bold'))
        );
    }
    
    public function hasNextRound()
    {
        return $this->currentRound < $this->nbRounds;
    }
    
    public function nextRound()
    {
        if($this->hasNextRound() === false)
        {
            throw new \RuntimeException("No next round");
        }
        
        $matches = $this->matches[$this->currentRound];
        $this->currentRound++;
        
        $this->output->writeln("<round>==========================================================================</round>");
        $this->output->writeln("<roundTitle>Round " . $this->currentRound . ' / ' . $this->nbRounds . "</roundTitle>");
        $this->output->writeln("<round>==========================================================================</round>");
        
        foreach($matches as $match)
        {
            $match->play();
            $this->updateRanking($match);

            $this->output->writeln($match->__toString());
        }
        
        $this->output->writeln('');
        
        $this->displayRanking();
    }
    
    private function updateRanking(Match $match)
    {
        $p1 = $match->getHome();
        $p2 = $match->getAway();
        
        $id1 = $p1->getId();
        $id2 = $p2->getId();
        
        $this->players[$id1]['played'] += 1;
        $this->players[$id2]['played'] += 1;
        
        $home = $match->getHomeGoals();
        $away = $match->getAwayGoals();
        
        $ga = $home - $away;
        $this->players[$id1]['goalAverage'] += $ga;
        $this->players[$id2]['goalAverage'] -= $ga;

        
        if($home === $away)
        {
            $this->players[$id1]['pts'] += 1;
            $this->players[$id2]['pts'] += 1;
            $this->players[$id1]['draw'] += 1;
            $this->players[$id2]['draw'] += 1;
            
            return;
        }
        
        $winner = $home > $away ? $id1 : $id2;
        $loser = $home < $away ? $id1 : $id2;
        
        $this->players[$winner]['pts'] += 3;
        $this->players[$winner]['won'] += 1;
        $this->players[$loser]['lost'] += 1;
        
    }
    
    private function initRanking(IdentifiedPlayer $p)
    {
        return array(
            'player' => $p,
            'pts' => 0,
            'goalAverage' => 0,
            'played' => 0,
            'won' => 0,
            'draw' => 0,
            'lost' => 0,
        );
    }
    
    private function displayRanking()
    {
        $data = array();
        foreach($this->players as $row)
        {
            $data[] = array(
                0,
                $row['player']->getName(),
                $row['pts'],
                $row['goalAverage'],
                $row['played'],
                $row['won'],
                $row['draw'],
                $row['lost'],
            );
        }
        
        // sort
        usort($data, function($r1, $r2){
            $diff = $r2[2] - $r1[2];
            
            if($diff === 0)
            {
                $diff = $r2[3] - $r1[3];
            }
            
        	return $diff;
        });
        
        // Update rank
        array_walk($data, function(&$item){
            static $counter = 1;
        	$item[0] = $counter++;
        });
        
        // Format leader
        array_walk($data[0], function(& $item){
            $item = "<leader>$item</leader>";	
        });
        
        $table = new CliTable($data);
        
        $table
            ->enableFormattingTags()
            ->setHeaders(array('Rank', 'Player', 'Points', 'GoalAverage', 'Played', 'Won', 'Draw', 'Lost'));
        
        $this->output->writeln($table->render());    
    }
} 