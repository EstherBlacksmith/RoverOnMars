<script>

  //Mars 
  var sliderX = document.getElementById("squareX");
  var outputX = document.getElementById("outputX");
  var sliderY = document.getElementById("squareY");
  var outputY = document.getElementById("outputY");

  outputX.innerHTML = sliderX.value; 

  sliderX.oninput = function() {
    outputX.innerHTML = this.value;
  }    

  outputY.innerHTML = sliderY.value;
  
  sliderY.oninput = function() {
    outputY.innerHTML = this.value;
  }

  //Rover
  var sliderRoverX = document.getElementById("XRoverPosition");
  var outputRoverX = document.getElementById("outputRoverX");
  var sliderRoverY = document.getElementById("YRoverPosition");
  var outputRoverY = document.getElementById("outputRoverY");

  outputRoverX.innerHTML = sliderRoverX.value; 

  sliderRoverX.oninput = function() {
    outputRoverX.innerHTML = this.value;
  }    

  outputRoverY.innerHTML = sliderRoverY.value;
  
  sliderRoverY.oninput = function() {
    outputRoverY.innerHTML = this.value;
  }
  
  //The Rover position
  function btnRover(){    

    deleteRover();   

    var initialX = document.getElementById('XRoverPosition').value -2;
    var initialY = document.getElementById('YRoverPosition').value -2;    

    var roverDiv =  document.getElementById(initialX + "_" + initialY);

    roverDiv.classList.add("rover");   

  }

  //The selected suqre for the Rover movements
  function btnSquare() {    

    var valueRows = document.getElementById('squareX').value;
    var valueColumns = document.getElementById('squareY').value;

    greyCells();
    
    for (r = 0; r < valueRows; r++) //rows    
    {   
      for (c = 0; c < valueColumns; c++) //columns
      {
        //document.getElementById(r + "_" + c).style.backgroundColor = 'orange';
        document.getElementById(r + "_" + c).classList.remove("greyCells");

        document.getElementById(r + "_" + c).classList.add("mars");

      } 
    }
  }

  function btnReset() { 
    
    greyCells();  
    deleteRover();   

    //reset the ranges values
    outputX.innerHTML = 2;
    outputY.innerHTML = 2;
  }

  function greyCells(){
    for (t = 0; t < 100; t++) //rows    
    {  
      document.getElementsByClassName("grid-item")[t].classList.remove("mars");
      document.getElementsByClassName("grid-item")[t].classList.add("greyCells");
    }
   
  }

  function deleteRover(){
     //In order to change the rover position, the previous rover image must be deleted   
    var rover = document.getElementsByClassName("rover");
    if (rover.length > 0) {
      document.getElementsByClassName("rover")[0].classList.remove("rover");
    }
  }

  </script>
