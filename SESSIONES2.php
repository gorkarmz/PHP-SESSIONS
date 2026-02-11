<?php
session_start();

// Inicializar carrito si no existe
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// to process the form
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // detect button (add or remove)
    if (isset($_POST['MODIFY'])) {

        // to add products
        $product = $_POST['extension'];
        $quantity = (int) $_POST['quantity'];

        // evaluate product
        if ($product !== "" && $quantity > 0) {

            // add quantity to corresponding product
            if (!isset($_SESSION['cart'][$product])) {
                $_SESSION['cart'][$product] = 0;
            }

            // add quantity to corresponding product
            $_SESSION['cart'][$product] += $quantity;
        }

    } elseif (isset($_POST['AVERAGE'])) {

        // to remove products
        $product = $_POST['extension'];
        $quantity = (int) $_POST['quantity'];

        // evaluate product
        if (isset($_SESSION['cart'][$product])) {

            // check if quantity is not greater than current one
            if ($quantity <= $_SESSION['cart'][$product]) {

                // substract from quantity to corresponding product
                $_SESSION['cart'][$product] -= $quantity;

                if ($_SESSION['cart'][$product] === 0) {
                    unset($_SESSION['cart'][$product]);
                }
            }
        }

    } elseif (isset($_POST['RESET'])) {
        $_SESSION['cart'] = [];
    }
}
?>

<h1>Supermercado Gorkaaaaaaaaaaaaa</h1>

<form method="post">

    <h2>Choose product</h2>
    <select name="extension" required>
        <option value="">--Selecciona--</option>
        <option value="0">Manzana</option>
        <option value="1">Pera</option>
        <option value="2">Mandarina</option>
    </select><br><br>

    <h2>Product quantity:</h2>
    <input type="number" name="quantity" min="1" required><br><br>

    <input type="submit" name="MODIFY" value="ADD">
    <input type="submit" name="AVERAGE" value="REMOVE">
    <input type="submit" name="RESET" value="RESET">
</form>

<h2>Current cart</h2>
<ul>
<?php
foreach ($_SESSION['cart'] as $product => $quantity) {
    echo "<li>Product $product: $quantity units</li>";
}
?>
</ul>
