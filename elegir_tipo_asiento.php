<?php
session_start();

echo '<pre>';
print_r($_SESSION['compra']);
echo '</pre>';

// Si necesitas la cantidad:
$cantidad_asientos = count($_SESSION['compra']['asientos']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Seleccionar Tipo de Boleto</title>

  <!-- ✅ Aquí va tu CSS embebido -->
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f7f7f7;
      padding: 40px;
      color: #333;
    }

    h2 {
      text-align: center;
      color: #222;
    }

    p {
      text-align: center;
      font-size: 18px;
    }

    form {
      background: #fff;
      max-width: 400px;
      margin: 30px auto;
      padding: 30px 40px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    input[type="number"] {
      width: 100%;
      padding: 8px 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-size: 16px;
    }

    button {
      margin-top: 25px;
      width: 100%;
      background: #007bff;
      color: #fff;
      border: none;
      padding: 12px;
      font-size: 16px;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background: #0056b3;
    }
  </style>
</head>

<body>

  <h2>Selecciona cuántos boletos de cada tipo quieres</h2>

  <p>Has elegido <strong><?php echo $cantidad_asientos; ?></strong> asientos.</p>

  <form action="guardar_tipo_asiento.php" method="post" onsubmit="return validarBoletos();">
    <label>General:</label>
    <input type="number" name="tipos_boletos[General]" value="0" min="0"><br>

    <label>Adulto Mayor:</label>
    <input type="number" name="tipos_boletos[Adulto Mayor]" value="0" min="0"><br>

    <label>Niño:</label>
    <input type="number" name="tipos_boletos[Niño]" value="0" min="0"><br>

    <input type="hidden" id="cantidad_asientos" value="<?php echo $cantidad_asientos; ?>">

    <button type="submit">Siguiente</button>
  </form>

  <script>
    function validarBoletos() {
      const general = parseInt(document.querySelector('[name="tipos_boletos[General]"]').value) || 0;
      const adultoMayor = parseInt(document.querySelector('[name="tipos_boletos[Adulto Mayor]"]').value) || 0;
      const nino = parseInt(document.querySelector('[name="tipos_boletos[Niño]"]').value) || 0;

      const totalBoletos = general + adultoMayor + nino;
      const cantidadAsientos = parseInt(document.getElementById('cantidad_asientos').value);

      if (totalBoletos !== cantidadAsientos) {
        alert(`Debes elegir exactamente ${cantidadAsientos} boletos en total.`);
        return false; // No envía el formulario
      }

      return true; // OK, envía el formulario
    }
  </script>

</body>
</html>
