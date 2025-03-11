<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
  session_start();
  if(!isset($_SESSION['array']))$_SESSION['array'] = [10, 20, 30];

  if (isset($_POST['modificar'])) {
    $pos = (int) $_POST['posicion'];
    $nuevoVal = (int) $_POST['nuevoVal'];
    if($pos >= 0 && $pos = count($_SESSION['array'])) $_SESSION['array'][$pos] = $nuevoVal;
  }

?>
<body>
    <h1>Modify</h1>
    <br>
    <h3>posicion a modificar</h3>
    <select name="modificar"><br>
            <option value="posicion">0</option>
            <option value="posicion">1</option>
            <option value="posicion">2</option>
        </select><br><br>

        <label for="">New value</label><br>
        <br>
        <input type="nuevoVal">
<br>    
<br>
        <button type="submit" name="modificar">Modify</button>
        <button type="submit" name="avarage">Avarage</button>
        <button type="submit" name="reset">Reset</button>

        <h2><?php echo 'array'?></h2>
</body>
</html>