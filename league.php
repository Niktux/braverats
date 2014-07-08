<?php

require 'vendor/autoload.php';

use Niktux\Braverats\Tournament\League;
use Niktux\Braverats\Players\Dumb;
use Niktux\Braverats\Players\StrongerFirst;
use Niktux\Braverats\Players\LessDumb;
use Niktux\Braverats\Players\Determinist;
use Niktux\Braverats\Tournament\PlayableLeague;

$players = array(
	new Dumb('Pif'),
	new Dumb('Al Heatouar'),
	new Dumb('Random'),
    new StrongerFirst(),
    new LessDumb('Lessie James'),
    new LessDumb('Less Tomber'),
    new LessDumb("Less O'Reuse"),
    new Determinist([4, 0, 7, 6, 5, 3, 2, 1]),
);

$league = new PlayableLeague(new League($players));

$first = true;

while($league->hasNextRound())
{
    if($first === false)
    {
        echo "\nPress a touch for next round ...";
        fgets(STDIN);
    }
    
    $first = false;
    $league->nextRound();
}
