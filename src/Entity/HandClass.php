<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Entity;
/**
 * Description of HandClass
 *
 * @author jakub.michulec
 */
class HandClass {
    
    private $cards;
    const ORDER_CARDS = [
        0 => '2',
        1 => '3',
        2 => '4',
        3 => '5',
        4 => '6',
        5 => '7',
        6 => '8',
        7 => '9',
        8 => 'T',
        9 => 'J',
        10 => 'Q',
        11 => 'K',
        12 => 'A'
    ];
    
    public function __construct() {
        $this->cards = [];
    }


    public function addCard($card){
        $cardValueByEveryChar = str_split($card);
        $cardValueAssociatedKeys = [
            'symbol' => $cardValueByEveryChar[0],
            'suit' => $cardValueByEveryChar[1]
        ];
        array_push($this->cards, $cardValueAssociatedKeys);
        if(count($this->cards) == 5){
            $this->cards = $this->_sortCardsBySymbols();
        }
    }
    
    public function getAllCards(){
        return $this->cards;
    }
    
    public function getCardsRank(){
        $result = 0;
        $resultName = $this->_checkCardsRankName();
        switch($resultName){
            case 'royalFlush':
                $result = 1;
                break;
            case 'straightFlush':
                $result = 2;
                break;
            case 'fourOfAKind':
                $result = 3;
                break;
            case 'fullHouse':
                $result = 4;
                break;
            case 'flush':
                $result = 5;
                break;
            case 'straight':
                $result = 6;
                break;
            case 'threeOfAKind':
                $result = 7;
                break;
            case 'twoPair':
                $result = 8;
                break;
            case 'onePair':
                $result = 9;
                break;
            case 'highCard':
                $result = 10;
                break;
        }
        
        return $result;
    }
    
    private function _sortCardsBySymbols(){
        $result = [];
        foreach(self::ORDER_CARDS as $orderElem){
            foreach($this->cards as $keyCurrentCard => $currentCard){
                if($orderElem == $currentCard['symbol']){
                    array_push($result,$currentCard);
                    unset($this->cards[$keyCurrentCard]);
                }
            }
        }
        return $result;
    }
    
    private function _checkCardsRankName(){
        $result = '';
        $isOneSuit = $this->_isOneSuit();
        if($isOneSuit){
            if($this->_isRoyalFlush()){
                $result = 'royalFlush';
            }elseif ($this->_isStraight()) {
                #all cards have same suit and all are in order - Straight Flush
                $result = 'straightFlush';
            }else{
                #all cards have same suit, but not in order - Flush
                $result = 'flush';
            }
        }else{
            if($this->_isStraight()){
                $result = 'straight';
            }else{
                $result = $this->_checkSameCards();
            }
        }
        
        return $result;
    }
    
    private function _isOneSuit(){
        $currentSuit = $this->cards[0]['suit'];
        foreach($this->cards as $card){
            if($card['suit'] != $currentSuit){
                return false;
            }
        }
        return true;
    }
    
    private function _isRoyalFlush(){
        if($this->cards[0]['symbol'] == 'T'
            && $this->cards[1]['symbol'] == 'J'
            && $this->cards[2]['symbol'] == 'Q'
            && $this->cards[3]['symbol'] == 'K'
            && $this->cards[4]['symbol'] == 'A'){
            return true;
        }
        return false;
    }
    
    private function _isStraight(){
        $orderCounter = 0;
        foreach(self::ORDER_CARDS as $keyOrderSymbol => $orderSymbol){
            if($orderSymbol == $this->cards[0]['symbol']){
                $orderCounter = $keyOrderSymbol;
                break;
            }
        }
        foreach($this->cards as $currentCard){
            if(self::ORDER_CARDS[$orderCounter] != $currentCard['symbol']){
                return false;
            }
        }
        return true;
    }
    
    private function _checkSameCards(){
        $result = '';
        $prevSymbol = '';
        $sameCounter = 1;
        $fourOfAKind = false;
        $threeOfAKind = false;
        $pair = false;
        $twoPair = false;
        foreach($this->cards as $currentCard){
            if($prevSymbol == $currentCard['symbol']){
                ++$sameCounter;
            }else{
                switch($sameCounter){
                    case 2:
                        if($pair){
                            $twoPair = true;
                            $pair = false;
                        }else{
                            $pair = true;
                        }
                        break;
                    case 3:
                        $threeOfAKind = true;
                        break;
                    case 4:
                        $fourOfAKind = true;
                        break;
                }
                $sameCounter = 1;
            }
            $prevSymbol = $currentCard['symbol'];
        }
        switch($sameCounter){
            case 2:
                if($pair){
                    $twoPair = true;
                    $pair = false;
                }else{
                    $pair = true;
                }
                break;
            case 3:
                $threeOfAKind = true;
                break;
            case 4:
                $fourOfAKind = true;
                break;
        }
        
        if($fourOfAKind){
            $result = 'fourOfAKind';
        }elseif($threeOfAKind){
            if($pair){
                $result = 'fullHouse';
            }else{
                $result = 'threeOfAKind';
            }
        }elseif($twoPair){
            $result = 'twoPair';
        }elseif($pair){
            $result = 'onePair';
        }else{
            $result = 'highCard';
        }
        
        return $result;
    }
}
