<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
</head>
<body>
    <h2>Registration Page</h2>
    <form method="POST" action="">
        <label for="matric">Matric:</label>
        <input type="text" name="matric" id="matric" required><br><br>

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="">Please select</option>
            <option value="Student">Student</option>
            <option value="Admin">Admin</option>
        </select><br><br>

        <button type="submit" name="submit">Submit</button>
    </form>

    <?php
    // Connect to Database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lab_5b";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection  
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['submit'])) {
        
        $matric = $_POST['matric'];
        $name = $_POST['name'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Enkripsi password
        $role = $_POST['role'];

        // Query to include data into users table
        $sql = "INSERT INTO users (matric, name, password, role) VALUES ('$matric', '$name', '$password', '$role')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Registration successful!</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }

    $conn->close();
    ?>
</body>
</html>