<?php

require 'vendor/autoload.php';

use Niktux\Braverats\Game;
use Niktux\Braverats\Players\Dumb;
use Niktux\Braverats\Players\LessDumb;
use Niktux\Braverats\Players\StrongerFirst;

$game = new Game(
    new Dumb(),
    new LessDumb()
);

$game->resolve();
