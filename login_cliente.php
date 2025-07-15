<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="css/movie.css">
  <link rel="stylesheet" href="css/producto.css">
</head>
<body>
    <div class="container_standard">
        <div class="container-content">
            <h2 id="login-form-header-text">Iniciar Sesión</h2><br>
            <form id="login-form" action="guardar_cliente.php" method="post">
                <label>Nombre:</label>
                <input type="text" name="nombre" required><br><br>

                <label>Correo:</label>
                <input type="email" name="correo" required><br><br>

                <button type="submit">Ingresar</button>
            </form>
        </div>
        
        
    </div>
</body>
</html>
