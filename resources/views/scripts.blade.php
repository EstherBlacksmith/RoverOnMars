<script>

  //Mars
  var sliderX = document.getElementById("XRange");
  var outputX = document.getElementById("Xvalue");
  var sliderY = document.getElementById("YRange");
  var outputY = document.getElementById("Yvalue");

  outputX.innerHTML = sliderX.value; 

  sliderX.oninput = function() {
    outputX.innerHTML = this.value;
  }    

  outputY.innerHTML = sliderY.value;
  
  sliderY.oninput = function() {
    outputY.innerHTML = this.value;
  }

  //Rover
  var sliderRoverX = document.getElementById("XRoverRange");
  var outputRoverX = document.getElementById("Xposition");
  var sliderRoverY = document.getElementById("YRoverRange");
  var outputRoverY = document.getElementById("Yposition");

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

    var initialX = document.getElementById('XRoverRange').value -2;
    var initialY = document.getElementById('YRoverRange').value -2;    

    var roverDiv =  document.getElementById(initialX + "_" + initialY);

    roverDiv.classList.add("rover");   

  }

  //The selected suqre for the Rover movements
  function btnSquare() {    

    var valueRows = document.getElementById('XRange').value;
    var valueColumns = document.getElementById('YRange').value;

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
