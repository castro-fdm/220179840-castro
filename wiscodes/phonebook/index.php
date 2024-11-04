<?php
    session_start();
    include 'db.php';

    $sql = "SELECT * FROM contacts";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phonebook</title>
</head>
<body>

    <?php
        if (isset($_SESSION['message'])) {
            echo "<p style='color: green;'>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']); 
        }
    ?>

    <h2>Phonebook Contacts</h2>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th colspan="2">Action</th> 
        </tr>
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                    echo "<td><a href='delete.php?id=" . urlencode($row['id']) . "'>Delete</a></td>";
                    echo "<td><a href='edit.php?id=" . urlencode($row['id']) . "'>Edit</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No Contacts</td></tr>";
            }
        ?>
    </table>
    <br>
    <a href="add.php">Add New Contact</a>
</body>
</html>
