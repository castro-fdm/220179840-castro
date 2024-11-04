<?php
session_start();
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM contacts WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $phone = $row['phone'];
    } else {
        echo "No contact found";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $id = $_POST['id'];

    if (!empty($name) && !empty($phone)) {
        $sql = "UPDATE contacts SET name='$name', phone='$phone' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Record updated successfully";
            header("Location: index.php");
            exit;
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Name and phone fields cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Contact</title>
</head>
<body>
  <h2>Edit Contact</h2>
  <form method="POST" action="edit.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    Name: <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"><br><br>
    Phone: <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>"><br><br>
    <input type="submit" value="Update Contact">
  </form>
  <a href="index.php">Back to Phonebook</a>
</body>
</html>
