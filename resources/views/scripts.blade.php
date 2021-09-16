<script>

  var sliderX = document.getElementById("XRange");
  var outputX = document.getElementById("Xvalue");
  var sliderY = document.getElementById("YRange");
  var outputY = document.getElementById("Yvalue");
  var roverDiv = document.getElementsByClassName("rover");
    outputX.innerHTML = sliderX.value; 

    sliderX.oninput = function() {
      outputX.innerHTML = this.value;
    }    
 
    outputY.innerHTML = sliderY.value;
   
    sliderY.oninput = function() {
      outputY.innerHTML = this.value;
    }
  
  function btnRover(){
    
    btnSquare();   

    var initialX = document.getElementById('initialPositionX').value -1;
    var initialY = document.getElementById('initialPositionY').value -1;    

    //In order to change the rvoer position, the old rover image must be deleted
    if(roverDiv){
      var forEach = Array.prototype.forEach;
      var image =  document.querySelector("div.rover").style.backgroundImage ;

      if (image == null){
        document.querySelector("div.rover").style.backgroundImage ="none" ;
        
       /* forEach.call(document.querySelectorAll("." + "rover"), function(node) {
          node.classList.remove( "rover");
          node.classList.backgroundImage =  "url('images/mars.jpg')";
        });*/

        //roverDiv.backgroundImage = "none";
      }
    }
    
    document.getElementById(initialX + "_" + initialY).style.backgroundImage = "url('images/rover.png')";
    //roverDiv.style.backgroundImage = "url('images/rover.png')";
    document.getElementById(initialX + "_" + initialY).addClass = "rover";
     //document.getElementById(initialX + "_" + initialY).style.backgroundImage = "url('images/rover.png')";
  }

  function btnSquare() { 

    var valueRows = document.getElementById('XRange').value;
    var valueColumns = document.getElementById('YRange').value;
    
    greyCells();
    
    for (r = 0; r < valueRows; r++) //rows    
    {   
      for (c = 0; c < valueColumns; c++) //columns
      {
        document.getElementById(r + "_" + c).style.backgroundColor = 'orange';
      } 
    }
  }

  function btnReset() { 
    
    greyCells();  

    outputX.innerHTML = 2;
    outputY.innerHTML = 2;
  }

  function greyCells(){
    for (t = 0; t < 100; t++) //rows    
    {  
      document.getElementsByClassName("grid-item")[t].style.backgroundColor = 'darkGrey';
    }
  }

  </script>
