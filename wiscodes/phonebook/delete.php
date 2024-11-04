<?php
session_start();
include 'db.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "DELETE FROM contacts WHERE id=$id";
  if ($conn->query($sql) === TRUE) {
    // Store success message in session
    $_SESSION['message'] = "Contact successfully deleted";
  } else {
    // Store error message in session
    $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
  }

  // Redirect to index page
  header("Location: index.php");
  exit;
}
?>
