<!DOCTYPE html>
<html>
<body>

<?php


// ary 10,20,30
if (!isset($_SESSION["array"])) {
    $_SESSION["array"] = array(10, 20, 30);
}

$avg = "";

// to process the form
// if req es post
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // when user click on a button
    // detect button (modify or average)

    // modify logic
    if (isset($_POST["MODIFY"])) {

        // get form data
        //$number = POST["value"]
        //$position = POST["position"]

        $number = $_POST["tamano"];
        $position = $_POST["extension"];

        // modify selected position
        //array[position] = number;

        for ($i = 0; $i < count($_SESSION["array"]); $i++) {
            if ($_SESSION["array"][$i] == $position) {
                $_SESSION["array"][$i] = $number;
            }
        }
    }

    // average logic
    if (isset($_POST["AVERAGE"])) {

        // calculate the average value (sum all values / number of values)
        // for array
        // total += pos

        $total = 0;
        foreach ($_SESSION["array"] as $pos) {
            $total += $pos;
        }

        //$avg = total/count(array)
        $avg = $total / count($_SESSION["array"]);
    }

    if (isset($_POST["RESET"])) {
        $_SESSION["array"] = array(10, 20, 30);
    }
}
?>

<h2>MODIFY ARRAY SAVED IN SESSION</h2>

<form method="post">
    Extension:
    <select name="extension">
        <option value="">--Selecciona--</option>
        <option value="10">0</option>
        <option value="20">1</option>
        <option value="30">2</option>
    </select><br><br>

    NEW VALUE:
    <input type="number" name="tamano" min="1"><br><br>

    <input type="submit" name="MODIFY" value="MODIFY">
    <input type="submit" name="AVERAGE" value="AVERAGE">
    <input type="submit" name="RESET" value="RESET">
</form>




</body>
</html>
