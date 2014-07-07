<?php

require 'vendor/autoload.php';

use Niktux\Braverats\Game;
use Niktux\Braverats\Players\Dumb;
use Niktux\Braverats\Players\LessDumb;
use Niktux\Braverats\Players\StrongerFirst;
use Niktux\Braverats\Players\Determinist;

$game = new Game(
    //new Determinist(array(4, 3, 1, 0, 5, 2, 6, 7)),
    new Dumb(),
    new LessDumb()
);

$game->resolve();
