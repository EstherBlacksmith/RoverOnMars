<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoverController extends Controller
{
    public $direction, $XRoverPosition, $YRoverPosition,$squareX, $squareY;
   
    /**Default values */
    function __construct() {     
        $this->direction = "N";
        $this->XRoverPosition = 0;
        $this->YRoverPosition = 0;
        $this->squareX = 0 ;
        $this->squareY = 0 ;
    }

    /**Initial Positions */
    function setInitialValues($request){
        $this->direction = $request->direction;
        $this->XRoverPosition = $request->XRoverPosition;
        $this->YRoverPosition = $request->YRoverPosition;
        $this->squareX = $request->squareX;
        $this->squareY = $request->squareY;        
    }
    
    function RoverPositionControl(){
        //Rover is inside the square
        if (($this->squareX < $this->XRoverPosition) || ($this->squareY < $this->YRoverPosition)){
            return false; //"Position incorrect value";
        }

        return true;
    }

    /**Movement parameters value control */
    function movementControl($movement){
        $correctValue = true;        
        
        if(count($movement) == 0){
            //There is an incorrect value for the movement
            $correctValue = false;
        }else{                
            foreach($movement as $order) {

                if(strlen($order) > 0){
                    $order = strtoupper($order);
                    if( ($order <> 'A') && ($order <> 'L') && ($order <> 'R') ){                         
                        //There is an incorrect value for the movement
                        $correctValue = false;                    
                    }
                 }
            }
        }

        return $correctValue;    
    }

    /**Coordinates parameters value control*/
    function coordinatesControl(){
        if (($this->squareX == null) || ($this->squareY  == null)){
            return false; 
        }

        if (($this->squareX == 0) || ($this->squareY  == 0)){
            return false; 
        }     
        return true;

    }

    /**Initial position value control */
    function positionControl($squareX,$squareY,$coordX,$coordY){
        if (!is_int($squareX) || !is_int($squareY)){
            return false; //"Position incorrect value";
        }

        if (($squareX > $coordX) || ($squareY > $coordY)){
            return false; //"Position incorrect value";
        }
        return true;      
    }

    /**Direction parameters value control (N,S,E,W) */
    function InitialDirectionControl(){
        $this->direction = mb_strtoupper($this->direction);

        if(($this->direction <> 'N') && ($this->direction <> 'S')
        && ($this->direction <> 'E') && ($this->direction <> 'W') ){
            return false;
        }

        return true;
    }  

    /**Square stack overflow Control */
    function overflowControl(){      
        if (($this->XRoverPosition > $this->squareX) || ($this->YRoverPosition > $this->squareY)){
            return false;
        }

        if (($this->XRoverPosition < 0) || ($this->YRoverPosition < 0)){
            return false;
        }       
        return true;
    }

    /**Orders validation */
    function valuesValidation(){
        if (!$this->RoverPositionControl()){
            return redirect('/mars')->with(['status'=> "The Rover position exceeds the design square"]);    
        }

        if(!$this->InitialDirectionControl()){
            return redirect('/mars')->with(['status'=> "The Rover direction is incorrect: ". $this->direction]);    
        }
       
        if(!$this->coordinatesControl()){
            return redirect('/mars')->with(['status'=> "Incorrect coordinates value"]);    
        }
    }

    /**Movement management (A,L,R)*/
    function movement(Request $request){   

        $this->setInitialValues($request);

        $this->valuesValidation();    

        $movementArray  = str_split($request->movement);

        if(!$this->movementControl($movementArray)){
            return redirect('/mars')->with(['status'=>  "Incorrect movement value"]);    
        }

        if (!$this->overflowControl()){
            return redirect('/mars')->with(['status'=>  "The Rover position exceeds the design square"]);     

        }

        //For every order must control if is a position o direction order
        foreach ($movementArray as $movement) {
            $movement = strtoupper($movement);

            if ($movement  == 'A') {
                $this->setPosition();
                 //While the coordinates are correct
                if(!$this->overflowControl()){                   
                    return redirect('/mars')->with(['status'=>  "The Rover position exceeds the design square"]);         
                }
            }else{               
                $this->setDirection($movement);
            }
        }

        return redirect('/mars')->with(['status'=>  "final position X->".$this->XRoverPosition."<br>"."final position Y->".$this->YRoverPosition."<br>"."Final direction->".$this->direction]);
    }

    /** Position management */
    function setPosition(){
        switch ($this->direction) {
            case 'E':
                ++$this->XRoverPosition;
                break;
            case 'W':
                --$this->XRoverPosition; 
                break;
            case 'S':
                --$this->YRoverPosition; 
                break;
            default: //N
                ++$this->YRoverPosition; 
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
    }


}
