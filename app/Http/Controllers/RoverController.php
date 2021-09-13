<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoverController extends Controller
{
    public $direction, $positionX, $positionY, $correctValues ;

    function __construct() {
        /**Initial Position */
        $this->direction = "N";
        $this->positionX = 0;
        $this->positionY = 0;
        $this->correctValues = array("A","L","R");
    }
    


    /**Movement parameters value control */
    function movementControl($movement){

        $incorrectValue = false;        
        
        if(count($movement) == 0){
            //There is an incorrect value for the movement
            $incorrectValue = true;
        }else{                
            foreach($movement as $order) {

                if(strlen($order) > 0){

                    if(($order <> 'A') && ($order <> 'a')
                    && ($order <> 'L') && ($order <> 'l')
                    && ($order <> 'R') && ($order <> 'r')){                         
                        //There is an incorrect value for the movement
                        $incorrectValue = true;                    
                    }
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

    /**Direction parameters value control (N,S,E,W) */
    function InitialDirectionControl($initialDirection){

        if(($initialDirection <> 'N') && ($initialDirection <> 'n')
        && ($initialDirection <> 'S') && ($initialDirection <> 's')
        && ($initialDirection <> 'E') && ($initialDirection <> 'e')
        && ($initialDirection <> 'W') && ($initialDirection <> 'w')){
            
            return false;
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
        if(!$this->directionControl($initialDirection)){
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
    function movement(Request $request){   

        $movementArray  = str_split($request->movement);
       
        if($this->movementControl($movementArray)){
            return "Incorrect movement value";
        }

        //For every order must control if is a position o direction order
        foreach ($movementArray as $movement) {

            if ($movement  == 'A') {
                $this->setPosition();

                 //While the coordinates are correct
                if(!$this->squareControl() === true){
                    return $this->squareControl();
                }
            }
            else{
                echo($this->setDirection($movement));
            }
        }

        
    }

    /** Position management */
    function setPosition(){
        switch ($this->direcction) {
            case 'E':
                $this->positionX = ++$this->positionX;
                break;
            case 'W':
                $this->positionX = --$this->positionX;
                break;
            case 'S':
                $this->positionY = --$this->positionY;
                break;
            default: //N
                $this->positionY = ++$this->positionY;
                break;
        }

    }

    /**Direction Management */
    function setDirection($movement){   

        if ($movement == 'L' || $movement == 'l'){

            switch ($this->direction) {
                case 'E':
                    $this->direction = 'N';
                    break;
                case 'S':
                    $this->direction = 'E';
                        break;
                case 'W':
                    $this->direction = 'S';
                    break;
                default: //N
                    $this->direction = 'W';
                    break;
            }

        }elseif ($movement =='R' || $movement == 'r') {
            switch ($this->direction) {
                case 'E':
                    $this->direction = 'S';
                    break;
                case 'S':
                    $this->direction = 'W';
                    break;
                case 'W':
                    $this->direction = 'N';
                    break;
                default: //N
                    $this->direction = 'E';
                break;
            }
        }
        
        return $this->direction;
    }


}
