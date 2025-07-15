<!DOCTYPE html>
<html>
<head>
    <title>Login Cliente</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="guardar_cliente.php" method="post">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Correo:</label><br>
        <input type="email" name="correo" required><br><br>

        <button type="submit">Ingresar</button>
    </form>
</body>
</html>
