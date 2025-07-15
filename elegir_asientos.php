<?php
session_start();

// 3️⃣ Debug opcional:
echo '<pre>';
print_r($_SESSION['compra']);
echo '</pre>';
?>

<!-- Aquí pondrías el formulario para elegir asientos -->
<form action="guardar_asientos.php" method="post">
  <input type="checkbox" name="asientos[]" value="A1"> A1<br>
  <input type="checkbox" name="asientos[]" value="A2"> A2<br>
  <input type="checkbox" name="asientos[]" value="A3"> A3<br>
  <input type="checkbox" name="asientos[]" value="A4"> A4<br>
  <input type="checkbox" name="asientos[]" value="A5"> A5<br>
  <input type="checkbox" name="asientos[]" value="B1"> B1<br>
  <input type="checkbox" name="asientos[]" value="B2"> B2<br>
  <input type="checkbox" name="asientos[]" value="B3"> B3<br>
  <input type="checkbox" name="asientos[]" value="B4"> B4<br>
  <input type="checkbox" name="asientos[]" value="B5"> B5<br>
  <input type="checkbox" name="asientos[]" value="C1"> C1<br>
  <input type="checkbox" name="asientos[]" value="C2"> C2<br>
  <input type="checkbox" name="asientos[]" value="C3"> C3<br>
  <input type="checkbox" name="asientos[]" value="C4"> C4<br>
  <input type="checkbox" name="asientos[]" value="C5"> C5<br>

  <button type="submit">Siguiente</button>
</form>

