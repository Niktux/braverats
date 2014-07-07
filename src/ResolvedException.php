<?php

namespace Niktux\Braverats;

class ResolvedException extends \Exception
{
    public
        $result;
    
    public function __construct($result)
    {
        $this->result = $result;
    }
}