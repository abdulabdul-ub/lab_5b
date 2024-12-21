<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h2>Login Page</h2>
    <form method="POST" action="">
        <label for="matric">Matric:</label>
        <input type="text" name="matric" id="matric" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <button type="submit" name="login">Login</button>
    </form>
    <p>Don't have an account? <a href="register_form.php">Register here</a></p>

    <?php
    // Connect to Database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lab_5b"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['login'])) {
        $matric = $_POST['matric'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE matric = '$matric'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password == $row['password']) { // Sesuaikan password tanpa hash untuk kemudahan testing
                // Login success
                echo "<p style='color: green;'>Login successfully!</p>";
                header("Refresh: 2; URL=display.php"); // Redirect ke display.php setelah 2 detik
                exit();
            } else {
                // Password wrong
                echo "<p style='color: red;'>Incorrect password!</p>";
            }
        } else {
            // Matric not found
            echo "<p style='color: red;'>Matric not found!</p>";
        }
    }

    $conn->close();
    ?>
</body>
</html>