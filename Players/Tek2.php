<?php

Class BlackJackPlayer_Tek2 extends BlackJackPlayer_HiLo
{

     public function shuffle()/*{{{*/
     {
          $this->losecount = 0 ;
     }/*}}}*/

     public function getBet( BlackJackGame $game ) /*{{{*/
     {
          if ( $this->losecount <= 1 )
               return 10 * $this->losecount * 10  ; 
          return 10 * $this->losecount * 5 ;
          if ( $this->losecount <= 1 )
               return 5 ; 
          elseif ( $this->losecount > 7 )
               return 100;
          else
               return 50 ;
     }/*}}}*/

     public function getTrueCount() { return 0 ; }

     private $losecount = 0;

     const WIN       = -3;
     const BLACKJACK = -4;
     const LOSE      = 2 ;
     const BUST      = 2;
     const PUSH      = 0; 

     public function win( )/*{{{*/
     {
          $this->losecount += self::WIN ;
          parent::win();
     }/*}}}*/

     public function blackjack( )/*{{{*/
     {
          $this->losecount += self::BLACKJACK;
          parent::blackjack();
     }/*}}}*/

     public function lose( )/*{{{*/
     {
          $this->losecount += self::LOSE ;
          parent::lose();
     }/*}}}*/

     public function bust( )/*{{{*/
     {
          $this->losecount += self::BUST ;
          parent::bust();
     }/*}}}*/

     public function push(  )/*{{{*/
     {
          $this->losecount += self::PUSH ;
          parent::push();
     }/*}}}*/
}
