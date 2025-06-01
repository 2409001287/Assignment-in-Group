<?php
// Database connection
$con = new mysqli('localhost', 'root', '', 'testdb');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Form submission logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Safely get all POST variables
    $first_name  = $con->real_escape_string($_POST['first_name']);
    $last_name   = $con->real_escape_string($_POST['last_name']);
    $email       = $con->real_escape_string($_POST['email']);
    $headline    = $con->real_escape_string($_POST['headline']);
    $summary     = $con->real_escape_string($_POST['summary']);
    $position    = isset($_POST['position']) ? $con->real_escape_string($_POST['position']) : '';
    $year        = isset($_POST['year']) ? (int)$_POST['year'] : 0;
    $description = $con->real_escape_string($_POST['description']);

    // Only insert if required values are not empty
    if (!empty($position) && $year > 0) {
        $sql = "INSERT INTO users 
                (first_name, last_name, email, headline, summary, position, year, description)
                VALUES 
                ('$first_name', '$last_name', '$email', '$headline', '$summary', '$position', '$year', '$description')";

        if ($con->query($sql) === TRUE) {
            echo "<p style='color:green;'>Profile added successfully!</p>";
        } else {
            echo "<p style='color:red;'>Error: " . $con->error . "</p>";
        }
    } else {
        echo "<p style='color:red;'>Please select a valid Position and Year.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adding Profile</title>
</head>
<body>
    <div style="margin:auto; border:2px solid #ccc; padding:20px; width:400px;">
        <h2>Adding Profile for Chuck</h2>
        <form method="POST">
            First Name:<br>
            <input type="text" name="first_name" required><br><br>

            Last Name:<br>
            <input type="text" name="last_name" required><br><br>

            Email:<br>
            <input type="email" name="email" required><br><br>

            Headline:<br>
            <input type="text" name="headline" required><br><br>

            Summary:<br>
            <textarea name="summary" rows="4" cols="40" required></textarea><br><br>

            Position:<br>
            <select name="position" required>
                <option value="">+</option>
                <option value="manager">Manager</option>
                <option value="developer">Developer</option>
                <option value="analyst">Analyst</option>
                <option value="designer">Designer</option>
            </select><br><br>

            Year:<br>
            <select name="year" required>
                <option value="">+</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
                <option value="2021">2021</option>
            </select><br><br>

            Description:<br>
            <textarea name="description" rows="4" cols="40"></textarea><br><br>

            <input type="submit" value="Add">
            <button type="reset">Cancel</button>
        </form>
    </div>
</body>
</html>
