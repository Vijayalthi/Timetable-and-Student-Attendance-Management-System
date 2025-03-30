<?php
include '../db/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];
        
        if ($row['role'] == 'admin') {
            header("Location: ../admin/dashboard.php");
        } elseif ($row['role'] == 'teacher') {
            header("Location: ../teacher/dashboard.php");
        } else {
            header("Location: ../student/dashboard.php");
        }
    } else {
        echo "Invalid login credentials";
    }
}
?>
