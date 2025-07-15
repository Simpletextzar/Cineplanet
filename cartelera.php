<form action="detalles_pelicula.php" method="get">
  <label for="Peliculas">Películas:</label>
  <select name="id_pelicula" id="pelicula1">
    <?php for ($i = 1; $i <= 10; $i++): ?>
      <option value="<?php echo $i; ?>">Película <?php echo $i; ?></option>
    <?php endfor; ?>
  </select>

  <button type="submit">Enviar</button>
</form>
