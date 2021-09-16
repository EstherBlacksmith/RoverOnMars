@include('layout')
<body>

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
          <label for="XRange" class="form-label">Initial position X</label>
          <input type="range" class="form-range mb-3" min="2" max="10" step="1" value="2" id="initialPositionX">
          <p>X Value: <span id="Xvalue"></span></p>

          <label for="YRange" class="form-label">Initial position Y</label>
          <input type="range" class="form-range mb-3" min="2" max="10" step="1" value="2" id="initialPositionY">
          <p>Y Value: <span id="Yvalue"></span></p>          
          
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
@include('scripts')

<footer>


</footer>