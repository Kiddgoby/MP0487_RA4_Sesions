<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
  session_start();

  // esto inicia la array
  if(!isset($_SESSION['array'])){  
    $_SESSION['array'] = [10, 20, 30];
  }

  // para modificar el valor lo que hay que hacer es...

  if (isset($_POST['modificar'])) {
      $pos = (int) $_POST['posicion'];
      $nuevoVal = (int) $_POST['nuevoVal'];

      if($pos >= 0 && $pos < count($_SESSION['array'])){ 
        //en la array guardamos el nuevo valor en la posicion
        $_SESSION['array'] [$pos] = $nuevoVal;
      
      }
    }

    //resetar la array a los valores naturales
    if (isset($_POST['reset'])) {
      $_SESSION ['array']=[10,20,30];
      
    }

    //calcular media
    $media = 0;
    if (isset($_POST['avarage'])) {
      $media = array_sum($_SESSION['array']) / count($_SESSION['array']);
    }

?>
<body>
    <h1>Modify</h1>

    <form method="post"> 
        <h3>Posición a modificar</h3>
        <select name="posicion"> 
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select><br><br>

        <label for="">New value</label><br>
        <input type="number" name="nuevoVal"><br><br> 

        <button type="submit" name="modificar">Modify</button>
        <button type="submit" name="avarage">Avarage</button>
        <button type="submit" name="reset">Reset</button>
    </form> 


        <h2>Array actual:</h2>
        <ul>
            <?php foreach ($_SESSION['array'] as $key => $value): ?>
                <li>Posición <?php echo $key; ?>: <?php echo $value; ?></li>
            <?php endforeach; ?>
        </ul>

        <?php if ($media !== null): ?>
            <h3>Promedio: <?php echo $media; ?></h3>
        <?php endif; ?>
</body>
</html>