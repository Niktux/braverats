<?php

namespace Niktux\Braverats;

class ResolverTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerTestResolve
     */
    public function testResolve($card1, $card2, $general1, $general2, $expected)
    {
        $r = new Resolver();
        $r->setCard1($card1)
            ->setCard2($card2)
            ->setBonus1($general1)
            ->setBonus2($general2);

        $this->assertSame($expected, $r->resolve());
    }
    
    public function providerTestResolve()
    {
        return array(
        	array(Card::MUSICIEN_0, Card::MUSICIEN_0, false, false, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::MUSICIEN_0, true, false, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::MUSICIEN_0, false, true, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::MUSICIEN_0, true, true, Resolver::DRAW),
                        
        	array(Card::MUSICIEN_0, Card::PRINCESSE_1, false, false, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::PRINCESSE_1, true, false, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::PRINCESSE_1, false, true, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::PRINCESSE_1, true, true, Resolver::DRAW),
                        
        	array(Card::MUSICIEN_0, Card::ESPION_2, false, false, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::ESPION_2, true, false, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::ESPION_2, false, true, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::ESPION_2, true, true, Resolver::DRAW),
                        
        	array(Card::MUSICIEN_0, Card::ASSASSIN_3, false, false, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::ASSASSIN_3, true, false, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::ASSASSIN_3, false, true, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::ASSASSIN_3, true, true, Resolver::DRAW),
                        
        	array(Card::MUSICIEN_0, Card::AMBASSADEUR_4, false, false, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::AMBASSADEUR_4, true, false, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::AMBASSADEUR_4, false, true, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::AMBASSADEUR_4, true, true, Resolver::DRAW),
                        
        	array(Card::MUSICIEN_0, Card::MAGICIEN_5, false, false, -1),
        	array(Card::MUSICIEN_0, Card::MAGICIEN_5, true, false, -1),
        	array(Card::MUSICIEN_0, Card::MAGICIEN_5, false, true, -1),
        	array(Card::MUSICIEN_0, Card::MAGICIEN_5, true, true, -1),
                        
        	array(Card::MUSICIEN_0, Card::GENERAL_6, false, false, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::GENERAL_6, true, false, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::GENERAL_6, false, true, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::GENERAL_6, true, true, Resolver::DRAW),
                        
        	array(Card::MUSICIEN_0, Card::PRINCE_7, false, false, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::PRINCE_7, true, false, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::PRINCE_7, false, true, Resolver::DRAW),
        	array(Card::MUSICIEN_0, Card::PRINCE_7, true, true, Resolver::DRAW),
                        
        	array(Card::PRINCESSE_1, Card::MUSICIEN_0, false, false, Resolver::DRAW),
        	array(Card::PRINCESSE_1, Card::MUSICIEN_0, true, false, Resolver::DRAW),
        	array(Card::PRINCESSE_1, Card::MUSICIEN_0, false, true, Resolver::DRAW),
        	array(Card::PRINCESSE_1, Card::MUSICIEN_0, true, true, Resolver::DRAW),
                        
        	array(Card::PRINCESSE_1, Card::PRINCESSE_1, false, false, Resolver::DRAW),
        	array(Card::PRINCESSE_1, Card::PRINCESSE_1, true, false, 1),
        	array(Card::PRINCESSE_1, Card::PRINCESSE_1, false, true, -1),
        	array(Card::PRINCESSE_1, Card::PRINCESSE_1, true, true, Resolver::DRAW),
                        
        	array(Card::PRINCESSE_1, Card::ESPION_2, false, false, -1),
        	array(Card::PRINCESSE_1, Card::ESPION_2, true, false, 1),
        	array(Card::PRINCESSE_1, Card::ESPION_2, false, true, -1),
        	array(Card::PRINCESSE_1, Card::ESPION_2, true, true, -1),
                        
        	array(Card::PRINCESSE_1, Card::ASSASSIN_3, false, false, 1),
        	array(Card::PRINCESSE_1, Card::ASSASSIN_3, true, false, Resolver::DRAW),
        	array(Card::PRINCESSE_1, Card::ASSASSIN_3, false, true, 1),
        	array(Card::PRINCESSE_1, Card::ASSASSIN_3, true, true, 1),
                        
        	array(Card::PRINCESSE_1, Card::AMBASSADEUR_4, false, false, -2),
        	array(Card::PRINCESSE_1, Card::AMBASSADEUR_4, true, false, -2),
        	array(Card::PRINCESSE_1, Card::AMBASSADEUR_4, false, true, -2),
        	array(Card::PRINCESSE_1, Card::AMBASSADEUR_4, true, true, -2),
                        
        	array(Card::PRINCESSE_1, Card::MAGICIEN_5, false, false, -1),
        	array(Card::PRINCESSE_1, Card::MAGICIEN_5, true, false, -1),
        	array(Card::PRINCESSE_1, Card::MAGICIEN_5, false, true, -1),
        	array(Card::PRINCESSE_1, Card::MAGICIEN_5, true, true, -1),
                        
        	array(Card::PRINCESSE_1, Card::GENERAL_6, false, false, -1),
        	array(Card::PRINCESSE_1, Card::GENERAL_6, true, false, -1),
        	array(Card::PRINCESSE_1, Card::GENERAL_6, false, true, -1),
        	array(Card::PRINCESSE_1, Card::GENERAL_6, true, true, -1),
                        
        	array(Card::PRINCESSE_1, Card::PRINCE_7, false, false, Resolver::WIN),
        	array(Card::PRINCESSE_1, Card::PRINCE_7, true, false, Resolver::WIN),
        	array(Card::PRINCESSE_1, Card::PRINCE_7, false, true, Resolver::WIN),
        	array(Card::PRINCESSE_1, Card::PRINCE_7, true, true, Resolver::WIN),
                        
        	array(Card::ESPION_2, Card::MUSICIEN_0, false, false, Resolver::DRAW),
        	array(Card::ESPION_2, Card::MUSICIEN_0, true, false, Resolver::DRAW),
        	array(Card::ESPION_2, Card::MUSICIEN_0, false, true, Resolver::DRAW),
        	array(Card::ESPION_2, Card::MUSICIEN_0, true, true, Resolver::DRAW),
                        
        	array(Card::ESPION_2, Card::PRINCESSE_1, false, false, 1),
        	array(Card::ESPION_2, Card::PRINCESSE_1, true, false, 1),
        	array(Card::ESPION_2, Card::PRINCESSE_1, false, true, -1),
        	array(Card::ESPION_2, Card::PRINCESSE_1, true, true, 1),
                        
        	array(Card::ESPION_2, Card::ESPION_2, false, false, Resolver::DRAW),
        	array(Card::ESPION_2, Card::ESPION_2, true, false, 1),
        	array(Card::ESPION_2, Card::ESPION_2, false, true, -1),
        	array(Card::ESPION_2, Card::ESPION_2, true, true, Resolver::DRAW),
                        
        	array(Card::ESPION_2, Card::ASSASSIN_3, false, false, 1),
        	array(Card::ESPION_2, Card::ASSASSIN_3, true, false, -1),
        	array(Card::ESPION_2, Card::ASSASSIN_3, false, true, 1),
        	array(Card::ESPION_2, Card::ASSASSIN_3, true, true, 1),
                        
        	array(Card::ESPION_2, Card::AMBASSADEUR_4, false, false, -2),
        	array(Card::ESPION_2, Card::AMBASSADEUR_4, true, false, Resolver::DRAW),
        	array(Card::ESPION_2, Card::AMBASSADEUR_4, false, true, -2),
        	array(Card::ESPION_2, Card::AMBASSADEUR_4, true, true, -2),
                        
        	array(Card::ESPION_2, Card::MAGICIEN_5, false, false, -1),
        	array(Card::ESPION_2, Card::MAGICIEN_5, true, false, -1),
        	array(Card::ESPION_2, Card::MAGICIEN_5, false, true, -1),
        	array(Card::ESPION_2, Card::MAGICIEN_5, true, true, -1),
                        
        	array(Card::ESPION_2, Card::GENERAL_6, false, false, -1),
        	array(Card::ESPION_2, Card::GENERAL_6, true, false, -1),
        	array(Card::ESPION_2, Card::GENERAL_6, false, true, -1),
        	array(Card::ESPION_2, Card::GENERAL_6, true, true, -1),
                        
        	array(Card::ESPION_2, Card::PRINCE_7, false, false, -1),
        	array(Card::ESPION_2, Card::PRINCE_7, true, false, -1),
        	array(Card::ESPION_2, Card::PRINCE_7, false, true, -1),
        	array(Card::ESPION_2, Card::PRINCE_7, true, true, -1),
                        
        	array(Card::ASSASSIN_3, Card::MUSICIEN_0, false, false, Resolver::DRAW),
        	array(Card::ASSASSIN_3, Card::MUSICIEN_0, true, false, Resolver::DRAW),
        	array(Card::ASSASSIN_3, Card::MUSICIEN_0, false, true, Resolver::DRAW),
        	array(Card::ASSASSIN_3, Card::MUSICIEN_0, true, true, Resolver::DRAW),
                        
        	array(Card::ASSASSIN_3, Card::PRINCESSE_1, false, false, -1),
        	array(Card::ASSASSIN_3, Card::PRINCESSE_1, true, false, -1),
        	array(Card::ASSASSIN_3, Card::PRINCESSE_1, false, true, Resolver::DRAW),
        	array(Card::ASSASSIN_3, Card::PRINCESSE_1, true, true, -1),
                        
        	array(Card::ASSASSIN_3, Card::ESPION_2, false, false, -1),
        	array(Card::ASSASSIN_3, Card::ESPION_2, true, false, -1),
        	array(Card::ASSASSIN_3, Card::ESPION_2, false, true, 1),
        	array(Card::ASSASSIN_3, Card::ESPION_2, true, true, -1),
                        
        	array(Card::ASSASSIN_3, Card::ASSASSIN_3, false, false, Resolver::DRAW),
        	array(Card::ASSASSIN_3, Card::ASSASSIN_3, true, false, -1),
        	array(Card::ASSASSIN_3, Card::ASSASSIN_3, false, true, 1),
        	array(Card::ASSASSIN_3, Card::ASSASSIN_3, true, true, Resolver::DRAW),
                        
        	array(Card::ASSASSIN_3, Card::AMBASSADEUR_4, false, false, 1),
        	array(Card::ASSASSIN_3, Card::AMBASSADEUR_4, true, false, -2),
        	array(Card::ASSASSIN_3, Card::AMBASSADEUR_4, false, true, 1),
        	array(Card::ASSASSIN_3, Card::AMBASSADEUR_4, true, true, 1),
                        
        	array(Card::ASSASSIN_3, Card::MAGICIEN_5, false, false, -1),
        	array(Card::ASSASSIN_3, Card::MAGICIEN_5, true, false, Resolver::DRAW),
        	array(Card::ASSASSIN_3, Card::MAGICIEN_5, false, true, -1),
        	array(Card::ASSASSIN_3, Card::MAGICIEN_5, true, true, -1),
                        
        	array(Card::ASSASSIN_3, Card::GENERAL_6, false, false, 1),
        	array(Card::ASSASSIN_3, Card::GENERAL_6, true, false, 1),
        	array(Card::ASSASSIN_3, Card::GENERAL_6, false, true, 1),
        	array(Card::ASSASSIN_3, Card::GENERAL_6, true, true, 1),
                        
        	array(Card::ASSASSIN_3, Card::PRINCE_7, false, false, -1),
        	array(Card::ASSASSIN_3, Card::PRINCE_7, true, false, -1),
        	array(Card::ASSASSIN_3, Card::PRINCE_7, false, true, -1),
        	array(Card::ASSASSIN_3, Card::PRINCE_7, true, true, -1),
                        
        	array(Card::AMBASSADEUR_4, Card::MUSICIEN_0, false, false, Resolver::DRAW),
        	array(Card::AMBASSADEUR_4, Card::MUSICIEN_0, true, false, Resolver::DRAW),
        	array(Card::AMBASSADEUR_4, Card::MUSICIEN_0, false, true, Resolver::DRAW),
        	array(Card::AMBASSADEUR_4, Card::MUSICIEN_0, true, true, Resolver::DRAW),
                        
        	array(Card::AMBASSADEUR_4, Card::PRINCESSE_1, false, false, 2),
        	array(Card::AMBASSADEUR_4, Card::PRINCESSE_1, true, false, 2),
        	array(Card::AMBASSADEUR_4, Card::PRINCESSE_1, false, true, 2),
        	array(Card::AMBASSADEUR_4, Card::PRINCESSE_1, true, true, 2),
                        
        	array(Card::AMBASSADEUR_4, Card::ESPION_2, false, false, 2),
        	array(Card::AMBASSADEUR_4, Card::ESPION_2, true, false, 2),
        	array(Card::AMBASSADEUR_4, Card::ESPION_2, false, true, Resolver::DRAW),
        	array(Card::AMBASSADEUR_4, Card::ESPION_2, true, true, 2),
                        
        	array(Card::AMBASSADEUR_4, Card::ASSASSIN_3, false, false, -1),
        	array(Card::AMBASSADEUR_4, Card::ASSASSIN_3, true, false, -1),
        	array(Card::AMBASSADEUR_4, Card::ASSASSIN_3, false, true, 2),
        	array(Card::AMBASSADEUR_4, Card::ASSASSIN_3, true, true, -1),
                        
        	array(Card::AMBASSADEUR_4, Card::AMBASSADEUR_4, false, false, Resolver::DRAW),
        	array(Card::AMBASSADEUR_4, Card::AMBASSADEUR_4, true, false, 2),
        	array(Card::AMBASSADEUR_4, Card::AMBASSADEUR_4, false, true, -2),
        	array(Card::AMBASSADEUR_4, Card::AMBASSADEUR_4, true, true, Resolver::DRAW),
                        
        	array(Card::AMBASSADEUR_4, Card::MAGICIEN_5, false, false, -1),
        	array(Card::AMBASSADEUR_4, Card::MAGICIEN_5, true, false, 1),
        	array(Card::AMBASSADEUR_4, Card::MAGICIEN_5, false, true, -1),
        	array(Card::AMBASSADEUR_4, Card::MAGICIEN_5, true, true, -1),
                        
        	array(Card::AMBASSADEUR_4, Card::GENERAL_6, false, false, -1),
        	array(Card::AMBASSADEUR_4, Card::GENERAL_6, true, false, Resolver::DRAW),
        	array(Card::AMBASSADEUR_4, Card::GENERAL_6, false, true, -1),
        	array(Card::AMBASSADEUR_4, Card::GENERAL_6, true, true, -1),
                        
        	array(Card::AMBASSADEUR_4, Card::PRINCE_7, false, false, -1),
        	array(Card::AMBASSADEUR_4, Card::PRINCE_7, true, false, -1),
        	array(Card::AMBASSADEUR_4, Card::PRINCE_7, false, true, -1),
        	array(Card::AMBASSADEUR_4, Card::PRINCE_7, true, true, -1),
                        
        	array(Card::MAGICIEN_5, Card::MUSICIEN_0, false, false, 1),
        	array(Card::MAGICIEN_5, Card::MUSICIEN_0, true, false, 1),
        	array(Card::MAGICIEN_5, Card::MUSICIEN_0, false, true, 1),
        	array(Card::MAGICIEN_5, Card::MUSICIEN_0, true, true, 1),
                        
        	array(Card::MAGICIEN_5, Card::PRINCESSE_1, false, false, 1),
        	array(Card::MAGICIEN_5, Card::PRINCESSE_1, true, false, 1),
        	array(Card::MAGICIEN_5, Card::PRINCESSE_1, false, true, 1),
        	array(Card::MAGICIEN_5, Card::PRINCESSE_1, true, true, 1),
                        
        	array(Card::MAGICIEN_5, Card::ESPION_2, false, false, 1),
        	array(Card::MAGICIEN_5, Card::ESPION_2, true, false, 1),
        	array(Card::MAGICIEN_5, Card::ESPION_2, false, true, 1),
        	array(Card::MAGICIEN_5, Card::ESPION_2, true, true, 1),
                        
        	array(Card::MAGICIEN_5, Card::ASSASSIN_3, false, false, 1),
        	array(Card::MAGICIEN_5, Card::ASSASSIN_3, true, false, 1),
        	array(Card::MAGICIEN_5, Card::ASSASSIN_3, false, true, Resolver::DRAW),
        	array(Card::MAGICIEN_5, Card::ASSASSIN_3, true, true, 1),
                        
        	array(Card::MAGICIEN_5, Card::AMBASSADEUR_4, false, false, 1),
        	array(Card::MAGICIEN_5, Card::AMBASSADEUR_4, true, false, 1),
        	array(Card::MAGICIEN_5, Card::AMBASSADEUR_4, false, true, -1),
        	array(Card::MAGICIEN_5, Card::AMBASSADEUR_4, true, true, 1),
                        
        	array(Card::MAGICIEN_5, Card::MAGICIEN_5, false, false, Resolver::DRAW),
        	array(Card::MAGICIEN_5, Card::MAGICIEN_5, true, false, 1),
        	array(Card::MAGICIEN_5, Card::MAGICIEN_5, false, true, -1),
        	array(Card::MAGICIEN_5, Card::MAGICIEN_5, true, true, Resolver::DRAW),
                        
        	array(Card::MAGICIEN_5, Card::GENERAL_6, false, false, -1),
        	array(Card::MAGICIEN_5, Card::GENERAL_6, true, false, 1),
        	array(Card::MAGICIEN_5, Card::GENERAL_6, false, true, -1),
        	array(Card::MAGICIEN_5, Card::GENERAL_6, true, true, -1),
                        
        	array(Card::MAGICIEN_5, Card::PRINCE_7, false, false, -1),
        	array(Card::MAGICIEN_5, Card::PRINCE_7, true, false, -1),
        	array(Card::MAGICIEN_5, Card::PRINCE_7, false, true, -1),
        	array(Card::MAGICIEN_5, Card::PRINCE_7, true, true, -1),
                        
        	array(Card::GENERAL_6, Card::MUSICIEN_0, false, false, Resolver::DRAW),
        	array(Card::GENERAL_6, Card::MUSICIEN_0, true, false, Resolver::DRAW),
        	array(Card::GENERAL_6, Card::MUSICIEN_0, false, true, Resolver::DRAW),
        	array(Card::GENERAL_6, Card::MUSICIEN_0, true, true, Resolver::DRAW),
                        
        	array(Card::GENERAL_6, Card::PRINCESSE_1, false, false, 1),
        	array(Card::GENERAL_6, Card::PRINCESSE_1, true, false, 1),
        	array(Card::GENERAL_6, Card::PRINCESSE_1, false, true, 1),
        	array(Card::GENERAL_6, Card::PRINCESSE_1, true, true, 1),
                        
        	array(Card::GENERAL_6, Card::ESPION_2, false, false, 1),
        	array(Card::GENERAL_6, Card::ESPION_2, true, false, 1),
        	array(Card::GENERAL_6, Card::ESPION_2, false, true, 1),
        	array(Card::GENERAL_6, Card::ESPION_2, true, true, 1),
                        
        	array(Card::GENERAL_6, Card::ASSASSIN_3, false, false, -1),
        	array(Card::GENERAL_6, Card::ASSASSIN_3, true, false, -1),
        	array(Card::GENERAL_6, Card::ASSASSIN_3, false, true, -1),
        	array(Card::GENERAL_6, Card::ASSASSIN_3, true, true, -1),
                        
        	array(Card::GENERAL_6, Card::AMBASSADEUR_4, false, false, 1),
        	array(Card::GENERAL_6, Card::AMBASSADEUR_4, true, false, 1),
        	array(Card::GENERAL_6, Card::AMBASSADEUR_4, false, true, Resolver::DRAW),
        	array(Card::GENERAL_6, Card::AMBASSADEUR_4, true, true, 1),
                        
        	array(Card::GENERAL_6, Card::MAGICIEN_5, false, false, 1),
        	array(Card::GENERAL_6, Card::MAGICIEN_5, true, false, 1),
        	array(Card::GENERAL_6, Card::MAGICIEN_5, false, true, -1),
        	array(Card::GENERAL_6, Card::MAGICIEN_5, true, true, 1),
                        
        	array(Card::GENERAL_6, Card::GENERAL_6, false, false, Resolver::DRAW),
        	array(Card::GENERAL_6, Card::GENERAL_6, true, false, 1),
        	array(Card::GENERAL_6, Card::GENERAL_6, false, true, -1),
        	array(Card::GENERAL_6, Card::GENERAL_6, true, true, Resolver::DRAW),
                        
        	array(Card::GENERAL_6, Card::PRINCE_7, false, false, -1),
        	array(Card::GENERAL_6, Card::PRINCE_7, true, false, -1),
        	array(Card::GENERAL_6, Card::PRINCE_7, false, true, -1),
        	array(Card::GENERAL_6, Card::PRINCE_7, true, true, -1),
                        
        	array(Card::PRINCE_7, Card::MUSICIEN_0, false, false, Resolver::DRAW),
        	array(Card::PRINCE_7, Card::MUSICIEN_0, true, false, Resolver::DRAW),
        	array(Card::PRINCE_7, Card::MUSICIEN_0, false, true, Resolver::DRAW),
        	array(Card::PRINCE_7, Card::MUSICIEN_0, true, true, Resolver::DRAW),
                        
        	array(Card::PRINCE_7, Card::PRINCESSE_1, false, false, -1 * Resolver::WIN),
        	array(Card::PRINCE_7, Card::PRINCESSE_1, true, false, -1 * Resolver::WIN),
        	array(Card::PRINCE_7, Card::PRINCESSE_1, false, true, -1 * Resolver::WIN),
        	array(Card::PRINCE_7, Card::PRINCESSE_1, true, true, -1 * Resolver::WIN),
                        
        	array(Card::PRINCE_7, Card::ESPION_2, false, false, 1),
        	array(Card::PRINCE_7, Card::ESPION_2, true, false, 1),
        	array(Card::PRINCE_7, Card::ESPION_2, false, true, 1),
        	array(Card::PRINCE_7, Card::ESPION_2, true, true, 1),
                        
        	array(Card::PRINCE_7, Card::ASSASSIN_3, false, false, 1),
        	array(Card::PRINCE_7, Card::ASSASSIN_3, true, false, 1),
        	array(Card::PRINCE_7, Card::ASSASSIN_3, false, true, 1),
        	array(Card::PRINCE_7, Card::ASSASSIN_3, true, true, 1),
                        
        	array(Card::PRINCE_7, Card::AMBASSADEUR_4, false, false, 1),
        	array(Card::PRINCE_7, Card::AMBASSADEUR_4, true, false, 1),
        	array(Card::PRINCE_7, Card::AMBASSADEUR_4, false, true, 1),
        	array(Card::PRINCE_7, Card::AMBASSADEUR_4, true, true, 1),
                        
        	array(Card::PRINCE_7, Card::MAGICIEN_5, false, false, 1),
        	array(Card::PRINCE_7, Card::MAGICIEN_5, true, false, 1),
        	array(Card::PRINCE_7, Card::MAGICIEN_5, false, true, 1),
        	array(Card::PRINCE_7, Card::MAGICIEN_5, true, true, 1),
                        
        	array(Card::PRINCE_7, Card::GENERAL_6, false, false, 1),
        	array(Card::PRINCE_7, Card::GENERAL_6, true, false, 1),
        	array(Card::PRINCE_7, Card::GENERAL_6, false, true, 1),
        	array(Card::PRINCE_7, Card::GENERAL_6, true, true, 1),
                        
        	array(Card::PRINCE_7, Card::PRINCE_7, false, false, Resolver::DRAW),
        	array(Card::PRINCE_7, Card::PRINCE_7, true, false, 1),
        	array(Card::PRINCE_7, Card::PRINCE_7, false, true, -1),
        	array(Card::PRINCE_7, Card::PRINCE_7, true, true, Resolver::DRAW),
        );
    }
}