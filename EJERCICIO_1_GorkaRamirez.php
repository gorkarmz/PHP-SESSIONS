<?php
session_start();

if (!isset($_SESSION['valores'])) {
    $_SESSION['valores'] = [10, 20, 30];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["reiniciar"])) {
        $_SESSION['valores'] = [10, 20, 30];
        unset($_SESSION['media']);
    }

    if (isset($_POST["editar"])) {
        $indice = $_POST["indice"];
        $nuevoValor = $_POST["numero"];

        if ($indice !== "" && $nuevoValor !== "") {
            $_SESSION['valores'][$indice] = (int)$nuevoValor;
        }
    }

    if (isset($_POST["calcular"])) {
        $sumaTotal = array_sum($_SESSION['valores']);
        $_SESSION['media'] = $sumaTotal / count($_SESSION['valores']);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Modificar Array</title>
</head>

<body>
    <h2>MODIFY ARRAYYY gorkaaaaaaa</h2>

    <form method="post">
        Selecciona pos:
        <select name="indice">
            <option value="">Elegir</option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select>

        <br><br>

        nuevo numero:
        <input type="number" name="numero" min="1">

        <br><br>

        <input type="submit" name="editar" value="modificar">
        <input type="submit" name="calcular" value="media">
        <input type="submit" name="reiniciar" value="reset">
    </form>

    <p><strong>Valores actuales:</strong> 
        <?php echo implode(" - ", $_SESSION['valores']); ?>
    </p>

    <?php 
    if (isset($_SESSION['media'])) {
        echo "<p><strong>Media:</strong> " . $_SESSION['media'] . "</p>";
    }
    ?>

</body>

</html>