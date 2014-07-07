<?php

namespace Niktux\Braverats;

interface Player
{
    /**
     * @return int
     */
    public function play();
    
    /**
     * @return string
     */
    public function getName();
}