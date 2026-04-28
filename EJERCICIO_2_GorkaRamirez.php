<?php
session_start();

if (!isset($_SESSION["leche"])) {
    $_SESSION["leche"] = 0;
}

if (!isset($_SESSION["refresco"])) {
    $_SESSION["refresco"] = 0;
}

$trabajador = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $trabajador = $_POST["trabajador"];

    if (isset($_POST["add"])) {

        $producto = $_POST["product"];
        $cantidad = (int)$_POST["quantity"];

        if ($producto == "leche") {
            $_SESSION["leche"] += $cantidad;
        }

        if ($producto == "refresco") {
            $_SESSION["refresco"] += $cantidad;
        }
    }

    if (isset($_POST["remove"])) {

        $producto = $_POST["product"];
        $cantidad = (int)$_POST["quantity"];

        if ($producto == "leche") {
            if ($cantidad > $_SESSION["leche"]) {
                $error = "no hay suficientes unidades";
            } else {
                $_SESSION["leche"] -= $cantidad;
            }
        }

        if ($producto == "refresco") {
            if ($cantidad > $_SESSION["refresco"]) {
                $error = "no hay suficientes unidades";
            } else {
                $_SESSION["refresco"] -= $cantidad;
            }
        }
    }

    if (isset($_POST["reset"])) {
        $_SESSION["leche"] = 0;
        $_SESSION["refresco"] = 0;
        $trabajador = "";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>goooorkaaaa</title>
</head>
<body>

<h1>Ejercicio 2 goooorkaaaa</h1>

<form method="POST">

    Nombre:
    <input type="text" name="trabajador" value="<?php echo $trabajador; ?>" required>
    <br><br>

    Producto:
    <select name="product">
        <option value="leche">leche</option>
        <option value="refresco">refresco</option>
    </select>
    <br><br>

    Cantidad:
    <input type="number" name="quantity" min="0" value="0">
    <br><br>

    <button type="submit" name="add">hola</button>
    <button type="submit" name="remove">ELIMINAR</button>
    <button type="submit" name="reset">RESET</button>

</form>

<br>

Trabajador: <?php echo $trabajador; ?><br>
Leche: <?php echo $_SESSION["leche"]; ?><br>
Refresco: <?php echo $_SESSION["refresco"]; ?><br>

<?php
if ($error != "") {
    echo $error;
}
?>

</body>
</html>