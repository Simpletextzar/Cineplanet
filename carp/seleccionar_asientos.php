<?php
include 'conexion.php';

$id_funcion = $_GET['id_funcion'] ?? null;

if (!$id_funcion) {
    die("ID de funcion no proporcionado.");
}

// Obtener sala de la funcion
$sqlSala = "SELECT id_sala_cine FROM funciones WHERE id_funcion = ?";
$stmtSala = $conexion->prepare($sqlSala);
$stmtSala->bind_param("i", $id_funcion);
$stmtSala->execute();
$resultSala = $stmtSala->get_result();
$sala = $resultSala->fetch_assoc();

if (!$sala) {
    die("Funcion no encontrada.");
}

$id_sala = $sala['id_sala_cine'];

// Obtener asientos de esa sala
$sqlAsientos = "SELECT id_asiento, fila, columna FROM asientos WHERE id_sala_cine = ? ORDER BY fila, columna";
$stmt = $conexion->prepare($sqlAsientos);
$stmt->bind_param("i", $id_sala);
$stmt->execute();
$result = $stmt->get_result();

$asientos = [];
while ($fila = $result->fetch_assoc()) {
    $asientos[] = $fila;
}

// Obtener asientos ya reservados para esa funcion
$sqlReservados = "SELECT id_asiento FROM reservas WHERE id_funcion = ? AND estado IN ('Pendiente', 'Pagada')";
$stmtR = $conexion->prepare($sqlReservados);
$stmtR->bind_param("i", $id_funcion);
$stmtR->execute();
$reservados = array_column($stmtR->get_result()->fetch_all(MYSQLI_ASSOC), 'id_asiento');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seleccionar Asientos</title>
    <style>
        .asiento {
            display: inline-block;
            width: 40px;
            height: 40px;
            margin: 3px;
            text-align: center;
            line-height: 40px;
            border: 1px solid #444;
            border-radius: 5px;
            cursor: pointer;
        }
        .ocupado {
            background-color: #e74c3c;
            cursor: not-allowed;
        }
        .seleccionado {
            background-color: #2ecc71;
        }
    </style>
</head>
<body>
    <h2>Selecciona tus asientos</h2>

    <form action="procesar_reserva.php" method="post">
        <input type="hidden" name="id_funcion" value="<?= $id_funcion ?>">
        <?php foreach ($asientos as $asiento): 
            $ocupado = in_array($asiento['id_asiento'], $reservados);
        ?>
            <label class="asiento <?= $ocupado ? 'ocupado' : '' ?>">
                <?php if (!$ocupado): ?>
                    <input type="checkbox" name="asientos[]" value="<?= $asiento['id_asiento'] ?>" style="display:none;">
                <?php endif; ?>
                <?= $asiento['fila'] . $asiento['columna'] ?>
            </label>
        <?php endforeach; ?>

        <br><br>
        <button type="submit">Reservar</button>
    </form>

    <script>
        // Mejora visual: marcar como seleccionado al hacer clic
        document.querySelectorAll('.asiento input[type="checkbox"]').forEach(chk => {
            chk.parentElement.addEventListener('click', function() {
                this.classList.toggle('seleccionado');
                chk.checked = !chk.checked;
            });
        });
    </script>
</body>
</html>
