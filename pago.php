<?php
session_start();

if (isset($_POST['metodo_pago'])) {
  $_SESSION['compra']['metodo_pago'] = $_POST['metodo_pago'];

  // ✅ Redirige directo a boleta.php
  header("Location: boleta.php");
  exit;
}

echo '<h2>Resumen Final de Compra:</h2>';
echo '<pre>';
print_r($_SESSION['compra']);
echo '</pre>';

// Si ya eligió método de pago y confirmó
if (isset($_POST['metodo_pago'])) {
  $metodo_pago = $_POST['metodo_pago'];
  $_SESSION['compra']['metodo_pago'] = $metodo_pago;

  echo "<h3>Pago realizado con éxito ✅</h3>";
  echo "<p>Método de pago elegido: <strong>$metodo_pago</strong></p>";
  echo "<p>¡Gracias por tu compra! 🎉</p>";
  // Aquí podrías insertar en base de datos, enviar correo, etc.
  exit;
}

// Si viene del paso inicial (hizo clic en Volver a cartelera)
if (isset($_POST['accion']) && $_POST['accion'] === 'volver') {
  header("Location: cartelera.php");
  exit;
}

// Si viene del paso inicial (hizo clic en Realizar pago)
if (isset($_POST['accion']) && $_POST['accion'] === 'pagar') {
  // Mostrar opciones de pago
  ?>

  <h3>Selecciona tu método de pago</h3>
  <form action="pago.php" method="post">
    <input type="radio" name="metodo_pago" value="Efectivo" required> Efectivo en taquilla<br>
    <input type="radio" name="metodo_pago" value="Tarjeta"> Tarjeta de crédito/débito<br>
    <input type="radio" name="metodo_pago" value="Yape/Plin"> Yape/Plin<br>

    <button type="submit">Finalizar Pago</button>
  </form>

  <?php
  exit;
}

// Vista inicial: volver o pagar
?>

<h3>¿Qué deseas hacer?</h3>
<form action="pago.php" method="post">
  <button type="submit" name="accion" value="volver">Volver a cartelera</button>
  <button type="submit" name="accion" value="pagar">Realizar pago</button>
</form>
