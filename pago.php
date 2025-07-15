<?php
session_start();

// ✅ Si el usuario eligió método de pago
if (isset($_POST['metodo_pago'])) {
  $_SESSION['compra']['metodo_pago'] = $_POST['metodo_pago'];

  // Redirige a boleta.php
  header("Location: boleta.php");
  exit;
}

// ✅ Si hizo clic en ‘Volver a cartelera’
if (isset($_POST['accion']) && $_POST['accion'] === 'volver') {
  header("Location: cartelera.php");
  exit;
}

// ✅ Si hizo clic en ‘Realizar pago’, muestra formulario
if (isset($_POST['accion']) && $_POST['accion'] === 'pagar') {
  ?>
  <!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>Elegir Método de Pago</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
        padding: 40px;
      }
      h3 {
        margin-bottom: 20px;
      }
      form {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        max-width: 400px;
        margin: auto;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      }
      label {
        display: block;
        margin-bottom: 10px;
      }
      button {
        margin-top: 20px;
        padding: 10px 20px;
        background: #007bff;
        border: none;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
      }
      button:hover {
        background: #0056b3;
      }
    </style>
  </head>
  <body>
    <h3>Selecciona tu método de pago</h3>
    <form action="pago.php" method="post">
      <label><input type="radio" name="metodo_pago" value="Efectivo" required> Efectivo en taquilla</label>
      <label><input type="radio" name="metodo_pago" value="Tarjeta"> Tarjeta de crédito/débito</label>
      <label><input type="radio" name="metodo_pago" value="Online"> Yape / Plin</label>
      <button type="submit">Finalizar Pago</button>
    </form>
  </body>
  </html>
  <?php
  exit;
}

// ✅ Vista inicial: volver o pagar
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Pago</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      padding: 40px;
      text-align: center;
    }
    h3 {
      margin-bottom: 20px;
    }
    form {
      display: inline-block;
    }
    button {
      margin: 0 10px;
      padding: 10px 20px;
      background: #28a745;
      border: none;
      color: #fff;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background: #218838;
    }
    button[name="accion"][value="volver"] {
      background: #6c757d;
    }
    button[name="accion"][value="volver"]:hover {
      background: #5a6268;
    }
  </style>
</head>
<body>
  <h3>¿Qué deseas hacer?</h3>
  <form action="pago.php" method="post">
    <button type="submit" name="accion" value="volver">Volver a cartelera</button>
    <button type="submit" name="accion" value="pagar">Realizar pago</button>
  </form>
</body>
</html>
