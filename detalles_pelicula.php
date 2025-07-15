<?php
// --------------------------------------------
// Verifica que venga el ID de la película
// --------------------------------------------
if (!isset($_GET['id_pelicula'])) {
    header("Location: cartelera.php");
    exit();
}

$id_pelicula = $_GET['id_pelicula'];

// --------------------------------------------
// Conexión BD
// --------------------------------------------
include 'conexion.php'; 

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
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Elegir Función</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    label {
      display: block;
      margin-top: 20px;
      margin-bottom: 6px;
      font-weight: bold;
    }
    select {
      width: 300px; /* ancho fijo, cambia según necesites */
      padding: 8px;
      font-size: 16px;
      box-sizing: border-box;
    }
  </style>
</head>
<body>
  <h1>Selecciona Ciudad, Cine y Fecha</h1>

  <!-- Formulario principal -->
  <form id="form_principal" action="guardar_funcion.php" method="post">
    <!-- ID película siempre va -->
    <input type="hidden" name="id_pelicula" value="<?php echo htmlspecialchars($id_pelicula); ?>">
    <!-- ID función se pone al elegir horario -->
    <input type="hidden" name="id_funcion" id="id_funcion">

    <!-- Ciudad -->
    <label>Ciudad:</label>
    <select name="id_ciudad" id="id_ciudad" required>
      <option value="">Seleccione Ciudad</option>
      <?php while ($ciudad = $ciudades->fetch_assoc()): ?>
        <option value="<?php echo $ciudad['id_ciudad']; ?>">
          <?php echo htmlspecialchars($ciudad['nombre']); ?>
        </option>
      <?php endwhile; ?>
    </select>
    <br><br>

    <!-- Cine -->
    <label>Cine:</label>
    <select name="id_cine" id="id_cine" required>
      <option value="">Seleccione primero una ciudad</option>
    </select>
    <br><br>

    <!-- Fecha -->
    <label>Fecha:</label>
    <select name="fecha_funcion" id="fecha_funcion" required>
      <option value="">Seleccione primero un cine</option>
    </select>
    <br><br>
  </form>

  <!-- Contenedor dinámico para horarios -->
  <div id="horarios_container">
    <!-- Aquí se muestran los grupos de horarios -->
  </div>

  <!-- JavaScript AJAX -->
  <script>
    // Cuando cambia Ciudad → carga Cines
    document.getElementById('id_ciudad').addEventListener('change', function() {
      var id_ciudad = this.value;
      var id_pelicula = <?php echo json_encode($id_pelicula); ?>;

      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'get_cines.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        console.log(this.responseText);
        document.getElementById('id_cine').innerHTML = this.responseText;
        document.getElementById('fecha_funcion').innerHTML = '<option value="">Seleccione primero un cine</option>';
        document.getElementById('horarios_container').innerHTML = '';
      };
      xhr.send('id_ciudad=' + id_ciudad + '&id_pelicula=' + id_pelicula);
    });

    // Cuando cambia Cine → carga Fechas
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

    // Cuando cambia Fecha → carga Horarios agrupados
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

    // Clic en horario → pone ID función y envía formulario
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
