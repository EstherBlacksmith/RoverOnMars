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
  <div class="row">
    <div class="col-sm-4">

      <form  method="post" action="{{ route('movement') }}">
        @csrf
        <div>
          <label for="initialPositionX" class="form-label">Initial position X</label>
          <input type="text" class="form-control" id="initialPositionX" name="initialPositionX" aria-describedby="Initial position X">
          <div id="initialPositionXHelp" class="form-text">Introduce the initial position in the axis X, for example 0 .</div>
        </div>

        <div>
          <label for="initialPositionY" class="form-label">Initial position Y</label>
          <input type="text" class="form-control" id="initialPositionY" name="initialPositionY" aria-describedby="Initial position Y">
          <div id="initialPositionYHelp" class="form-text">Introduce the initial position in the axis Y, for example 1 .</div>
        </div>

        <div>
          <label for="movement" class="form-label">Movement:  <span style="color:#ffa600">A</span>dvance, Turn  <span style="color:#ffa600">L</span>eft, Turn  <span style="color:#ffa600">R</span>ight. </label>
          <input type="text" class="form-control" id="movement" name="movement" aria-describedby="Movement">
          <div id="movementHelp" class="form-text">Introduce the movement for the Rover, for example <span style="color:#ffa600">AALARALLAA</span>.</div>
        </div>
    
      
        <div>
          <p>Create the square for the Rover movement</p>
          <select class="form-select  form-select-sm" id="SelectColumns">
            <option selected>Select colums</option>
            @for ($colum = 2; $colum < 11; $colum++)
            <option value="{{$colum}}">{{{$colum}}}</option>      
            @endfor
          </select>
          
          <select class="form-select form-select-sm" id="SelectRows">
            <option selected>Select rows</option>
            @for ($row = 2; $row < 11; $row++)
            <option value="{{$row}}">{{{$row}}}</option>      
            @endfor
          </select>
          <button type="button" class="btn btn-primary" onclick="btnSquare()">Mars</button>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <input class="btn btn-primary" type="reset" value="Reset" onclick="btnReset()">

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
  function btnSquare() {
    
    btnReset();

    var selectRows = document.getElementById('SelectRows');
    var SelectColumns = document.getElementById('SelectColumns');

    var valueRows = selectRows.options[selectRows.selectedIndex].value;
    var valueColumns = SelectColumns.options[SelectColumns.selectedIndex].value;

    for (r = 0; r < valueRows; r++) //rows    
    {   
      for (c = 0; c < valueColumns; c++) //columns
      {
        document.getElementById(r + "_" + c).style.backgroundColor = 'orange';
      } 
    }
  }

  function btnReset() {  

    for (t = 0; t < 100; t++) //rows    
    {  
      document.getElementsByClassName("grid-item")[t].style.backgroundColor = 'darkGrey';
    }
    
  }
  </script>

<footer>


</footer>