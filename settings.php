<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>PIStatus - Settings</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <style>
      .container{
        padding-top: 20px;
      }
     </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
    <ul class="nav nav-tabs">
      <li role="presentation"><a href="index.html">Dashboard</a></li>
      <li role="presentation" class="active"><a href="settings.php">Settings</a></li>
    </ul>

<div class="container">

<?php
if(is_writable('config.php')==FALSE){
    echo '<div class="alert alert-danger" role="alert"><strong>Error!</strong> config.php is not writable, change permissions.</div>';
}
?>

  <h2>Temp Settings</h2>

  <form action="settings.php" method="post">
      <div class="form-group">
          <label for="value1">Warning Threshold:</label>
          <input type="number" class="form-control" name="value1" id="value1" placeholder="45">
          <input type="hidden" name="line" value="2" />
      </div>
      <button type="submit" class="btn btn-default">Save</button>
  </form>
<br>
   <form action="settings.php" method="post">
      <div class="form-group">
        <label for="value1">Danger Threshold:</label>
        <input type="number" class="form-control" name="value1" id="value1" placeholder="55">
        <input type="hidden" name="line" value="3" />
      </div>
      <button type="submit" class="btn btn-default">Save</button>
   </form>
   <br>

<?php
   $postValue = $_POST['value1'];
   $postLine = $_POST['line'];

   if($postLine!=null){
     changeLine($postLine, $postValue);
   }

   function changeLine($lineNumber, $newValue){

       $fp = fopen('config.php','r+');
       $configFile = file("config.php");
       $buffer = $configFile[$lineNumber];
       //Cut String
       $pos = strrpos($buffer, "=");
       $buffer = substr($buffer ,0, $pos+1);
       //Rebuild String
       $buffer = ($buffer.$newValue.";"."\n");

       //Write
       $configFile[$lineNumber] = $buffer;
       $writeResult = fwrite($fp, implode($configFile));
         if($writeResult!=FALSE){
             echo '<div class="alert alert-success" role="alert">Saved</div>';
         }else{
            echo '<div class="alert alert-danger" role="alert"><strong>Error!</strong> An Error occurred writing the new value</div>';
         }
       fclose($fp);
   }
?>


</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/push.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
  </body>
</html>
