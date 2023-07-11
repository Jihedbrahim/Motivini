<?php
session_start();

if (isset($_SESSION['username'])) {
    echo $_SESSION['username'];
} else {
    echo "Guest";
}
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the entered username and password

    // Prepare and execute the query using prepared statements
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($storedPassword);
        $stmt->fetch();

        // Verify the entered password with the stored password
        if (password_verify($password, $storedPassword)) {
            // Passwords match, login successful
            $_SESSION['username'] = $username; // Store the username in the session

            // Redirect to the index page
            header("Location: index.html");
            exit;
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>
