<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div style="text-align:center">
            <input type="number" name="num01" placeholder="Number 1">
            <select name="operator" id="operator">
                <option value="add">+</option>
                <option value="substract">-</option>
                <option value="multiply">*</option>
                <option value="divide">/</option>
            </select>
            <input type="number" name="num02" placeholder="Number 2">
            <br>
            <br>
            <button style="color:black; background-color:gray; font-size:20px ;">Calculate</button>
        </div>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //gGrab data from inputs
        //$number1 = htmlspecialchars($_POST["num01"]);
        $number1 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT);
        //$number2 = htmlspecialchars($_POST["num02"]);
        $number2 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT);
        $operator = htmlspecialchars($_POST["operator"]);
        //ERROR handlers
        $errors = false;
        if (empty($number1) || empty($number2) || empty($operator)) {
            echo "<p class='calc-error'>Fill in all field! </p>";
            $errors = true;
        } else if (!is_numeric($number1) || !is_numeric($number2)) {
            echo "<p class='calc-error'>Only write numbers!</p>";
            $errors = true;
        }
        //Calculate the numbers if no errors 
        if (!$errors) {
            $value = 0;
            switch ($operator) {
                case "add":
                    $value = $number1 + $number2;
                    break;
                case "substract":
                    $value = $number1 - $number2;
                    break;
                case "multiply":
                    $value = $number1 * $number2;
                    break;
                case "divide":
                    $value = $number1 / $number2;
                    break;
                default:
                    echo "Error, Do it again";
            }
            echo "RESULT = " . $value;
        }
    }
    ?>
</body>

</html>