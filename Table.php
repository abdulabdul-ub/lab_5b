<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Users</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 2px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Users List</h2>
    <table>
        <thead>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connection to Database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "lab_5b"; 

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Delete data
            if (isset($_GET['delete'])) {
                $matricToDelete = $_GET['delete'];
                $deleteSql = "DELETE FROM users WHERE matric = '$matricToDelete'";
                if ($conn->query($deleteSql) === TRUE) {
                    echo "<p style='color: green;'>User deleted successfully!</p>";
                } else {
                    echo "<p style='color: red;'>Error deleting user: " . $conn->error . "</p>";
                }
            }

            // Show data 
            $sql = "SELECT matric, name, role FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['matric']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['role']}</td>
                            <td>
                                <a href='update_form.php?matric={$row['matric']}'>Update</a> |
                                <a href='display.php?delete={$row['matric']}' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No users found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>