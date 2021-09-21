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

          <label for="squareX" class="form-label"></label>
          <input type="range" class="form-range mb-3" min="2" max="10" step="1" value="2" id="squareX" name="squareX">
          <p>X Value: <span id="outputX"></span></p>

          <label for="squareY" class="form-label"></label>
          <input type="range" class="form-range mb-3" min="2" max="10" step="1" value="2" id="squareY"  name="squareY">
          <p>Y Value: <span id="outputY"></span></p>
     
          <button type="button" class="btn btn-success btn-lg mb-3" onclick="btnSquare()">Mars</button>
        </div>
        <div class="col-sm-6">           
          <label for="XRoverPosition" class="form-label">Initial position X</label>
          <input type="range" class="form-range mb-3" min="2" max="10" step="1" value="2" id="XRoverPosition" name="XRoverPosition">
          <p>X position: <span id="outputRoverX"></span></p>

          <label for="YRoverPosition" class="form-label">Initial position Y</label>
          <input type="range" class="form-range mb-3" min="2" max="10" step="1" value="2" id="YRoverPosition" name="YRoverPosition">
          <p>Y position: <span id="outputRoverY"></span></p>          
          
          <button type="button" class="btn btn-success btn-lg mb-3" onclick="btnRover()">Rover</button>

        </div>  

        <div>
          <label for="movement" class="form-label">Movement:  <span style="color:#ffa600">A</span>dvance, Turn  , Turn  <span style="color:#ffa600">R</span>ight. </label>
          <input type="text" class="form-control mb-3" id="movement" name="movement" aria-describedby="Movement">
          <div id="movementHelp" class="form-text  mb-3">Introduce the movement for the Rover, for example <span style="color:#ffa600">AALARALLAA</span>.</div>
        </div>
        
        
        <div>
          <label for="direction" class="form-label">Initial direction:  <span style="color:#ffa600">N</span>orth,  <span style="color:#ffa600">S</span>outh, <span style="color:#ffa600">E</span>ast or <span style="color:#ffa600">W</span>est. </label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="direction" id="directionN" value="N" checked>
            <label class="form-check-label" for="north">
              North
            </label>
          </div>
  
          <div class="form-check">
            <input class="form-check-input" type="radio" name="direction" id="directionS" value="N">
            <label class="form-check-label" for="south">
              South
            </label>
          </div>
  
          <div class="form-check">
            <input class="form-check-input" type="radio" name="direction" id="directionW" value="W">
            <label class="form-check-label" for="west">
              West
            </label>
          </div>
  
          <div class="form-check mb-3">
            <input class="form-check-input" type="radio" name="direction" id="directionE" value="E">
            <label class="form-check-label" for="east">
              East
            </label>
          </div>
          <div id="directionHelp" class="form-text  mb-3">Introduce the initial direction for the Rover, for example <span style="color:#ffa600"><span style="color:#ffa600">N</span>orth</span>.</div>
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
            <div class="grid-item greyCells" id="{{$r}}_{{$c}}" ></div>       
          @endfor
        @endfor    

      </div>
    </div>

  </div>
 
</div>
<div style="background-color: #ffa600">
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

</div>
</body>
@include('scripts')

<footer>


</footer>