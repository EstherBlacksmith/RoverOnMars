<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Rover on Mars!</title>
  </head>

<body>
<style>
  .grid {
    display: grid;
    grid-template-columns: repeat(10, 1fr);
    grid-auto-rows: minmax(40px, auto);
    grid-gap: 1px;
  }

  .grid-item {
    border: 1px solid black;
  }
</style>
<div class="container">
  <div class="h1">
    MARS

  </div>
  <div class="row">
    <div class="col-sm-4">

      <form  method="post" action="{{ route('movement') }}">
        @csrf      

        <div>
          <p>Select the size for the square for the Rover movement</p>

          <label for="XRange" class="form-label"></label>
          <input type="range" class="form-range mb-3" min="2" max="10" step="1" value="2" id="XRange">
          <p>X Value: <span id="Xvalue"></span></p>

          <label for="YRange" class="form-label"></label>
          <input type="range" class="form-range mb-3" min="2" max="10" step="1" value="2" id="YRange">
          <p>Y Value: <span id="Yvalue"></span></p>
     
          <button type="button" class="btn btn-success btn-lg mb-3" onclick="btnSquare()">Mars</button>
        </div>
        <div class="col-sm-6">
          <select class="form-select form-select mb-2" id="initialPositionX"  name="initialPositionX">
            <option selected>Initial position X</option>
            <div id="initialPositionXHelp" class="form-text">Introduce the initial position in the axis X, for example 0 .</div>
            @for ($colum = 2; $colum < 11; $colum++)
            <option value="{{$colum}}">{{{$colum}}}</option>      
            @endfor
          </select>
          
          <select class="form-select form-select mb-3" id="initialPositionY" name="initialPositionY">
            <option selected>Initial position Y</option>
            <div id="initialPositionXHelp" class="form-text">Introduce the initial position in the axis X, for example 0 .</div>
            @for ($row = 2; $row < 11; $row++)
            <option value="{{$row}}">{{{$row}}}</option>      
            @endfor
          </select>
          <button type="button" class="btn btn-success btn-lg mb-3" onclick="btnRover()">Rover</button>

        </div>  

        <div>
          <label for="movement" class="form-label">Movement:  <span style="color:#ffa600">A</span>dvance, Turn  <span style="color:#ffa600">L</span>eft, Turn  <span style="color:#ffa600">R</span>ight. </label>
          <input type="text" class="form-control mb-3" id="movement" name="movement" aria-describedby="Movement">
          <div id="movementHelp" class="form-text  mb-3">Introduce the movement for the Rover, for example <span style="color:#ffa600">AALARALLAA</span>.</div>
        </div>

        <button type="submit" class="btn btn-primary mb-3">Submit</button>
        <input class="btn btn-primary mb-3" type="reset" value="Reset" onclick="btnReset()">

      </form>    
    </div>

    <div class="col-sm-4">
      <p> MARS</p>
      <div class="grid">
        @for ($r = 9; $r >= 0; $r--) <!--rows -->
          @for ($c = 0; $c < 10; $c++) <!--columns -->
            <div class="grid-item" id="{{$r}}_{{$c}}" style="background-color: darkGrey"></div>       
          @endfor
        @endfor    

      </div>
    </div>

  </div>
 
</div>

</body>
<script>

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
  
  function btnRover(){
    
    btnSquare();   

    var initialX = document.getElementById('initialPositionX').value -1;
    var initialY = document.getElementById('initialPositionY').value -1;
   // document.getElementById(initialX + "_" + initialY).style.backgroundColor = 'blue';
    document.getElementById(initialX + "_" + initialY).style.backgroundImage = "url('images/mars.jpg')";



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

<footer>


</footer>