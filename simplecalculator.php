<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Simple Calculator</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="calculator">
  <h1>Simple Calculator</h1>
  <form method="POST" action="">
    <input type="number" name="num1" placeholder="Enter first number" required>
    <input type="number" name="num2" placeholder="Enter second number" required>

    <select name="operation" required>
      <option value="add">Addition (+)</option>
      <option value="subtract">Subtraction (-)</option>
      <option value="multiply">Multiplication (×)</option>
      <option value="divide">Division (÷)</option>
    </select>

    <button type="submit" name="submit">Calculate</button>
  </form>

  <?php
  if (isset($_POST['submit'])) {
    $num1 = (float)$_POST['num1'];
    $num2 = (float)$_POST['num2'];
    $operation = $_POST['operation'];
    $result = '';

    switch ($operation) {
      case 'add':
        $result = $num1 + $num2;
        break;
      case 'subtract':
        $result = $num1 - $num2;
        break;
      case 'multiply':
        $result = $num1 * $num2;
        break;
      case 'divide':
        if ($num2 == 0) {
          $result = "Cannot divide by zero!";
        } else {
          $result = $num1 / $num2;
        }
        break;
      default:
        $result = "Invalid operation selected.";
    }

    echo "Result: $result";
     
  }
  ?>
</div>

</body>
</html>