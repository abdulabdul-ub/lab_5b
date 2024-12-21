<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
    <h2>Update User</h2>
    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lab_5b"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['matric'])) {
        $matric = $_GET['matric'];
        $sql = "SELECT * FROM users WHERE matric = '$matric'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form method="POST" action="">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>" required><br><br>

                <label for="role">Role:</label>
                <input type="text" name="role" id="role" value="<?php echo $row['role']; ?>" required><br><br>

                <button type="submit" name="update">Update</button>
            </form>
            <?php
        } else {
            echo "<p style='color: red;'>User not found!</p>";
        }
    }

    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $role = $_POST['role'];

        $updateSql = "UPDATE users SET name = '$name', role = '$role' WHERE matric = '$matric'";
        if ($conn->query($updateSql) === TRUE) {
            echo "<p style='color: green;'>User updated successfully!</p>";
            header("Refresh: 2; URL=display.php"); 
            exit();
        } else {
            echo "<p style='color: red;'>Error updating user: " . $conn->error . "</p>";
        }
    }

    $conn->close();
    ?>
</body>
</html>