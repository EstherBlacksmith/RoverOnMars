<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoverController extends Controller
{
    public $direction, $positionX, $positionY,$squareX, $squareY;

    function __construct() {
        /**Initial Position */
        $this->direction = "N";
        $this->positionX = 0;
        $this->positionY = 0;
        $this->squareX = 0 ;
        $this->squareY = 0 ;

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
                    $order = strtoupper($order);
                    if( ($order <> 'A') && ($order <> 'L') && ($order <> 'R') ){                         
                        //There is an incorrect value for the movement
                        $incorrectValue = true;                    
                    }
                 }
            }
        }

        return $incorrectValue;    
    }

    /**Coordinates parameters value control*/
    function coordinatesControl($squareX, $squareY){      
        if (!is_int($squareX) || !is_int($squareY)){
            return "Coordinates incorrect value";
        }

        if (($squareX == 0) || ($squareY == 0)){
            return "Coordinates incorrect value";
        }     

    }

    /**Initial position value control */
   /* function positionControl($squareX,$squareY,$coordX,$coordY){

        if (!is_int($squareX) || !is_int($squareY)){
            return "Position incorrect value";
        }

        if (($squareX > $coordX) || ($squareY > $coordY)){
            return "Position incorrect value";
        }
      
    }*/

    /**Direction parameters value control (N,S,E,W) */
    function InitialDirectionControl($initialDirection){

        $initialDirection = mb_strtoupper($initialDirection);

        if(($initialDirection <> 'N') && ($initialDirection <> 'S')
        && ($initialDirection <> 'E') && ($initialDirection <> 'W') ){
            return false;
        }
    }


    /**Set initial direction */
    function setInitialDirection($initialDirection){

        if($this->InitialDirectionControl($initialDirection)){
            $direction = $initialDirection;
        }else{
            return "Incorrect Initial direction value";
        }
    }   

 
    /**Set initial position */
    function setInitialPosition($XRoverRange,$YRoverRange){
        if($this->InitialDirectionControl($this->direction)){
            $direction = $this->direction;
            if($this->squareControl($XRoverRange,$YRoverRange)){
                $this->positionX = $XRoverRange;
                $this->positionY = $YRoverRange;
            }else{
                return  "Stack overflow 1";
            }
            
        }else{
            return "Incorrect initial position";
        }    
        
    }

    /**Square Control */
    function squareControl($XRoverRange,$YRoverRange){
        echo "positionX->".$this->positionX."Range x:".$XRoverRange."<br>". "position Y->".$this->positionY."Range y:".$YRoverRange."<br>" ;
        if (($this->positionX < $XRoverRange) || ($this->positionY < $YRoverRange)){
            return false;
        }

        if (($this->positionX < 0) || ($this->positionY < 0)){
            return false;
        }

        

        return true;
    }

    /**Movement management (A,L,R)*/
    function movement(Request $request){   

        $movementArray  = str_split($request->movement);
        $XRoverRange = $request->XRoverRange;
        $YRoverRange = $request->YRoverRange;

        $this->setInitialPosition($request->XRoverRange,$request->YRoverRange);

        if($this->movementControl($movementArray)){
            return "Incorrect movement value";
        }

        if ($this->squareControl($XRoverRange,$YRoverRange)){
            return $this->squareControl($XRoverRange,$YRoverRange);
        }else{
            echo("X->".$XRoverRange." Y->".$YRoverRange);
            return  "Stack overflow 2";
        }

        //For every order must control if is a position o direction order
        foreach ($movementArray as $movement) {
            $movement = strtoupper($movement);
            if ($movement  == 'A') {
                $this->setPosition();

                 //While the coordinates are correct
                if($this->squareControl($XRoverRange,$YRoverRange) === true){
                    return $this->squareControl($XRoverRange,$YRoverRange);
                }else{
                    return  "Stack overflow 3";
                }
            }
            else{
                echo($this->setDirection($movement));
            }
        }

        
    }

    /** Position management */
    function setPosition(){
        switch ($this->direction) {
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
        $movement = strtoupper($movement);

        if ($movement == 'L'){

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

        }elseif ($movement =='R') {
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
