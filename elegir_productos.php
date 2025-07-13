<?php
session_start();

// 2️⃣ Mostrar estructura actual
echo '<h3>Estado actual de la compra:</h3>';
echo '<pre>';
print_r($_SESSION['compra']);
echo '</pre>';
?>

<h2>Elige tus productos opcionales</h2>

<form action="guardar_productos.php" method="post">
  <label>Gaseosa:</label>
  <input type="number" name="cantidad[Gaseosa]" value="0" min="0"><br>

  <label>Combo (Palomitas + Gaseosa):</label>
  <input type="number" name="cantidad[Combo]" value="0" min="0"><br>

  <label>Palomitas Dulce:</label>
  <input type="number" name="cantidad[PalomitasDulce]" value="0" min="0"><br>

  <label>Hot Dog:</label>
  <input type="number" name="cantidad[HotDog]" value="0" min="0"><br>

  <button type="submit">Siguiente</button>
</form>
