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
    
	public function play($opponentCard = null)
	{
	    return $this->player->play($opponentCard);
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
	
	public function opponentHasPlayed($card)
	{
	    return $this->player->opponentHasPlayed($card);
	}
	
	public function setBonuses($myBonus, $opponentBonus)
	{
	    return $this->player->setBonuses($myBonus, $opponentBonus);
	}
	
	public function __clone()
	{
	   $this->player = clone $this->player;    
	}
}