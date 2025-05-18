<?php
$conn = new mysqli("localhost", "root", "", "ecofinds");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM users WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user["password"])) {
    echo "Login successful! Welcome, " . $user["username"];
  } else {
    echo "Invalid email or password.";
  }
}
?>
