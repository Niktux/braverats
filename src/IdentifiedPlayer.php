<?php

namespace Niktux\Braverats;

class IdentifiedPlayer implements Player
{
    private
        $id,
        $name,
        $player;

    public function __construct(Player $player)
    {
	    $this->id = sha1(serialize($player));
	    $this->name = null;
        $this->player = $player;
    }
    
	public function play()
	{
	    return $this->player->play();
	}

	public function getName()
	{
	    if($this->name === null)
	    {
	       $this->name = $this->player->getName();
	    }
	    
	    return $this->name;
	}
	
	public function getId()
	{
	    return $this->id;
	}
}