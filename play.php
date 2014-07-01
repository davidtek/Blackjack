<?php

require_once('Game.php');
require_once('Player.php');

$start = 100;

$bj = new BlackJackGame();

$players = array(); 
$players[] = new BlackJackPlayer( $start = 100 ); 

require_once( 'Players/HiLo.php' );     $players[] = new BlackJackPlayer_HiLo( $start );
require_once( 'Players/HiLoOpt1.php' ); $players[] = new BlackJackPlayer_HiLoOpt1( $start );
require_once( 'Players/HiLoOpt2.php' ); $players[] = new BlackJackPlayer_HiLoOpt2( $start );
require_once( 'Players/OmegaII.php' );  $players[] = new BlackJackPlayer_OmegaII( $start );
require_once( 'Players/Red7.php' );     $players[] = new BlackJackPlayer_Red7( $start );
require_once( 'Players/ZenCount.php' ); $players[] = new BlackJackPlayer_ZenCount( $start );

$max = $start;

$roundsRemaining = array_key_exists(1, $argv) ? $argv[1] : 1;
$hands = 0;

$origPlayers = $players ;
$rounds = array();

try
{
     while ( $roundsRemaining-- > 0 && count($players) )
     {
          foreach ( $players as $k => $player )
          {
               var_dump($player->hasMoney($bj ) );
               if ( !$player->hasMoney( $bj ) )
               {
                    echo "Player $k is out of money, left the table\n";

                    $rounds[$k] = $hands;
                    unset($players[$k] );
               }
               else
                    $rounds[$k] = $hands ;
          }

          if ( count( $players ) === 0 ) throw new exception( "Everyone is bankrupt" );

          echo count($players);
          $hands++; 
          $bj->deal( $players );
     }
}
catch(exception $e )
{
     echo "Exception : \n";
     echo $e->getMessage()."\n";
}

foreach ( $origPlayers as $k => $player )
{
     $gain = $player->getMoney() - $start ;

     $hands = $rounds[$k];

     if ( $gain > 0 )
          echo get_class($player).": Player walked away with {$player->getMoney()}, that's a gain of {$gain} but peaked at {$player->getPeak()} with $hands played \n" ;
     else
          echo get_class($player)." : Player walked away with {$player->getMoney()}, that's a loss of ".abs($gain)." but peaked at {$player->getPeak()} with $hands played \n" ;
}







