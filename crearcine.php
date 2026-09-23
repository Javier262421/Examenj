<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die("Could not connect. " . $e->getMessage());
}

try {
  $sql = "CREATE DATABASE cine";
  $conn->exec($sql);
  echo "Database created successfully";
} catch(PDOException $e) {
  // Handle errors during db creation
  echo "Error creating database: " . $sql . "<br>" . $e->getMessage();
}

// Close connection
$conn = null;
?>