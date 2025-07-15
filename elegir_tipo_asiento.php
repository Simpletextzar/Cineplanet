<?php
session_start();

echo '<pre>';
print_r($_SESSION['compra']);
echo '</pre>';


// Si necesitas la cantidad:
$cantidad_asientos = count($_SESSION['compra']['asientos']);
?>

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
