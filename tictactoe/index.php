<!DOCTYPE html>
<html lang="en">
<head>
  <title>Unbeatable Tic-Tac-Toe</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
    
  </style>
</head>
<body>

<div class="jumbotron text-center" style="background-color: #21546e">
  <h1>Unbeatable Tic-Tac-Toe</h1>
</div>
  
<div class="container">
  <div class="row">
    <div class="col-sm-12">

      <div class="text-center">
        <button style="margin-right: 2%" type="button" class="btn btn-success" id="reset">Reset</button>
        <button style="margin-right: 2%" type="button" class="btn btn-success" id="secondPlay">Second Play</button>
    </div>

        <table style="margin-top: 2%" align="center">
          
          <tr>
            <td><label class="label" for="inpt1" id="box1" name="box1"></label></td>
            <td><label class="label" for="inpt2" id="box2" name="box2"></label></td>
            <td><label class="label" for="inpt3" id="box3" name="box3"></label></td>
          </tr>

          <tr>
            <td><label class="label" for="inpt4" id="box4" name="box4"></label></td>
            <td><label class="label" for="inpt5" id="box5" name="box5"></label></td>
            <td><label class="label" for="inpt6" id="box6" name="box6"></label></td>
          </tr>

          <tr>
            <td><label class="label" for="inpt7" id="box7" name="box7"></label></td>
            <td><label class="label" for="inpt8" id="box8" name="box8"></label></td>
            <td><label class="label" for="inpt9" id="box9" name="box9"></label></td>
          </tr>
        </table>

        <form hidden>
          <input class="input" type="text" name="inpt1" id="inpt1" value="0"></input>
          <input class="input" type="text" name="inpt2" id="inpt2" value="0"></input>
          <input class="input" type="text" name="inpt3" id="inpt3" value="0"></input>
          <input class="input" type="text" name="inpt4" id="inpt4" value="0"></input>
          <input class="input" type="text" name="inpt5" id="inpt5" value="0"></input>
          <input class="input" type="text" name="inpt6" id="inpt6" value="0"></input>
          <input class="input" type="text" name="inpt7" id="inpt7" value="0"></input>
          <input class="input" type="text" name="inpt8" id="inpt8" value="0"></input>
          <input class="input" type="text" name="inpt9" id="inpt9" value="0"></input>
        </form>

    </div>
    <!-- <div class="col-sm-6">
      <form>
        <div class="form-group">
          <textarea class="form-control" id="log" rows="15"></textarea>
      </div>
      </form>
  </div> -->
</div>
<script src="js/main.js"></script>
</body>
</html>
