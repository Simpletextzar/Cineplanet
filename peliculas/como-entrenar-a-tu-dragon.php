<?php
include '../conexion.php';

// --------------------------------------------
// Verifica que venga el ID de la película
// --------------------------------------------
if (!isset($_GET['id_pelicula'])) {
    header("Location: ../index.html");
    exit();
}

$id_pelicula = $_GET['id_pelicula'];

// --------------------------------------------
// Trae CIUDADES que tengan la película
// --------------------------------------------
$sql_ciudades = "
    SELECT DISTINCT ciudades.id_ciudad, ciudades.nombre
    FROM ciudades
    JOIN cines ON ciudades.id_ciudad = cines.id_ciudad
    JOIN salas_cine ON cines.id_cine = salas_cine.id_cine
    JOIN funciones ON salas_cine.id_sala_cine = funciones.id_sala_cine
    WHERE funciones.id_pelicula = ?
";

$stmt = $mysqli->prepare($sql_ciudades);
$stmt->bind_param("i", $id_pelicula);
$stmt->execute();
$ciudades = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Cineplanet - Funciones</title>
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../css/movie.css">
    <style>
      select {
        width: 300px;
        padding: 8px;
        margin: 10px 0;
      }
    </style>
</head>
<body>
<div id="root">
  <div class="home-page">
    <div class="hero-header">
      <div class="header">
        <div class="header--content">
          <div class="header_large">
            <a href="../index.html" class="header--logo-container">
              <img class="header--logo" src="../img/logo/Cineplanet_logo.svg">
            </a>
            <ul class="header--main-menu" id="menu-text">
              <li class="header--main-menu-item">
                <a class="header--main-menu-link">Películas</a>
              </li>
              <li class="header--main-menu-item">
                <a class="header--main-menu-link">Cines</a>
              </li>
              <li class="header--main-menu-item">
                <a class="header--main-menu-link">Dulcería</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Detalles película -->
    <div class="container container_standard movie_container">
      <div class="container-content">
        <div class="title-container">
          <h1 class="title-container--title">Cómo entrenar a tu dragón</h1>
        </div>
        <div class="movie-detail-grid">
          <div class="movie-grid--movie-photo">
            <img src="https://cdn.apis.cineplanet.com.pe/CDN/media/entity/get/FilmPosterGraphic/HO00002334?referenceScheme=HeadOffice&allowPlaceHolder=true">
          </div>
          <div class="movie-grid--sinopsis">
            <h2>Sinopsis</h2>
            <p>En la isla de Berk... (sinopsis resumida)</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Selector dinámico -->
    <div class="container container_standard movie_container">
      <div class="container-content">
        <div class="title-container">
          <h1 class="title-container--title">Selecciona tu función</h1>
        </div>
        <form id="form_principal" action="../guardar_funcion.php" method="post">
          <input type="hidden" name="id_pelicula" value="<?php echo htmlspecialchars($id_pelicula); ?>">
          <input type="hidden" name="id_funcion" id="id_funcion">

          <label>Ciudad:</label><br>
          <select name="id_ciudad" id="id_ciudad" required>
            <option value="">Seleccione Ciudad</option>
            <?php while ($ciudad = $ciudades->fetch_assoc()): ?>
              <option value="<?php echo $ciudad['id_ciudad']; ?>">
                <?php echo htmlspecialchars($ciudad['nombre']); ?>
              </option>
            <?php endwhile; ?>
          </select>

          <label>Cine:</label><br>
          <select name="id_cine" id="id_cine" required>
            <option value="">Seleccione primero una ciudad</option>
          </select>

          <label>Fecha:</label><br>
          <select name="fecha_funcion" id="fecha_funcion" required>
            <option value="">Seleccione primero un cine</option>
          </select>
        </form>

        <div id="horarios_container"></div>
      </div>
    </div>
  </div>
</div>

<script>
// Ciudad → Cines
document.getElementById('id_ciudad').addEventListener('change', function() {
  var id_ciudad = this.value;
  var id_pelicula = <?php echo json_encode($id_pelicula); ?>;

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'get_cines.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    document.getElementById('id_cine').innerHTML = this.responseText;
    document.getElementById('fecha_funcion').innerHTML = '<option value="">Seleccione primero un cine</option>';
    document.getElementById('horarios_container').innerHTML = '';
  };
  xhr.send('id_ciudad=' + id_ciudad + '&id_pelicula=' + id_pelicula);
});

// Cine → Fechas
document.getElementById('id_cine').addEventListener('change', function() {
  var id_cine = this.value;
  var id_pelicula = <?php echo json_encode($id_pelicula); ?>;

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'get_fechas.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    document.getElementById('fecha_funcion').innerHTML = this.responseText;
    document.getElementById('horarios_container').innerHTML = '';
  };
  xhr.send('id_cine=' + id_cine + '&id_pelicula=' + id_pelicula);
});

// Fecha → Horarios
document.getElementById('fecha_funcion').addEventListener('change', function() {
  var id_cine = document.getElementById('id_cine').value;
  var fecha = this.value;
  var id_pelicula = <?php echo json_encode($id_pelicula); ?>;

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'get_horarios.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    document.getElementById('horarios_container').innerHTML = this.responseText;
  };
  xhr.send('id_cine=' + id_cine + '&id_pelicula=' + id_pelicula + '&fecha=' + fecha);
});

// Click en horario
document.addEventListener('click', function(e) {
  if (e.target.classList.contains('horario-btn')) {
    var id_funcion = e.target.getAttribute('data-id_funcion');
    document.getElementById('id_funcion').value = id_funcion;
    document.getElementById('form_principal').submit();
  }
});
</script>

</body>
</html>
