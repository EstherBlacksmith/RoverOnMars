<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Rover extends Controller
{
     
    /**Initial Position */
    var $direction = "N";
    var $positionX = 0;
    var $positionY = 0;

    /**Movement parameters value control */
    function movementControl($movement){

        $incorrectValue = false;
        $correctValues = array("A","L","R");
        
        if (length($correctValues) == 0){
            //There is an incorrect value for the movement
            $incorrectValue = true;
        }else{      

            for ($i=0; $i <= length($correctValues) ; $i++) { 
                $correctValues[$i] = stripos($movement, $correctValues);
                if ($correct === false) {
                    //There is an incorrect value for the movement
                    $incorrectValue = true;
                }
            }        
        }

        return $incorrectValue;      

    }

    /**Coordinates parameters value control*/
    function coordinatesControl($coordX,$coordY){      
        if (!is_int($initialX) || !is_int($initialY)){
            return "Coordinates incorrect value";
        }

        if (($initialX == 0) || ($initialY == 0)){
            return "Coordinates incorrect value";
        }     

    }

    /**Initial position value control */
    function positionControl($initialX,$initialY,$coordX,$coordY){

        if (!is_int($initialX) || !is_int($initialY)){
            return "Position incorrect value";
        }

        if (($initialX > $coordX) || ($initialY > $coordY)){
            return "Position incorrect value";
        }
      
    }

    /**Set initial direction */
    function setInitialDirection($initialDirection){

        if(!$this->InitialDirectionControl($initialDirection)){
            $direction = $initialDirection;
        }else{
            return "Incorrect Initial direction value";
        }
    }   

    /**Set initial position */
    function setInitialPosition($initialX,$initialY){

        if(!$this->movementControl($initialDirection)){
            $direction = $initialDirection;
        }else{
            return "Incorrect value";
        }    
        
    }

    /**Square Control */
    function squareControl(){
        
        if (($positionX > $coordX) || ($positionY > $coordY)){
            return "Stack overflow";
        }

        if (($positionX < 0) || ($positionY < 0)){
            return "Stack overflow";
        }

        return true;
    }

    /**Movement management (A,L,R)*/
    function movement($movement){    
       
        
        //For every order must control if is a position o direction order
        for ($i=0; $i <= length($movement) ; $i++) { 
            $movement[$i] = stripos($movement, $correctValues);
            if ($movement[$i]  == 'A') {
                $this->position();

                 //While the coordinates are correct
                if(!$this->squareControl() === true){
                    return $this->squareControl();
                }
            }
            else{
                $this->direction($movement[$i]);
            }
        }   

    }

    /** Position management */
    function position(){
        switch ($direcction) {
            case 'E':
                $positionX = ++$positionX;
                break;
            case 'W':
                $positionX = --$positionX;
                break;
            case 'S':
                $positionY = --$positionY;
                break;
            default: //N
                $positionY = ++$positionY;
                break;
        }

    }

    /**Direction Management */
    function direction($movement){ 

        if($this->movementControl($movement)){        
            return "Incorrect value";
        }        

        if ($movement == 'L'){

            switch ($direction) {
                case 'E':
                    $direction = 'N';
                    break;
                case 'S':
                    $direction = 'E';
                        break;
                case 'W':
                    $direction = 'S';
                    break;
                default: //N
                    $direction = 'W';
                    break;
            }

        }elseif ($movement =='R') {
        
            switch ($direction) {
                case 'E':
                    $direction = 'S';
                    break;
                case 'S':
                    $direction = 'W';
                    break;
                case 'W':
                    $direction = 'N';
                    break;
                default: //N
                    $direction = 'E';
                break;
            }
        }
    }
}
