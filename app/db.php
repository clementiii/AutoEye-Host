<?php

// Get Heroku ClearDB connection information or use local development settings
$cleardb_url = getenv("CLEARDB_DATABASE_URL");

if ($cleardb_url) {
    $cleardb_url = parse_url($cleardb_url);
    $host = $cleardb_url["host"];
    $user = $cleardb_url["user"];
    $password = $cleardb_url["pass"];
    $dbname = substr($cleardb_url["path"], 1);
} else {
    // Local development configuration
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "AutoEye";
}

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
