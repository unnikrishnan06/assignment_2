<?php
try {
    $dbHost = 'localhost';
    $dbName = 'assignment2';
    $dbUser = 'root';
    $dbPass = '';
    $port   = 3307;

    $connection = new PDO("mysql:host=$dbHost;port=$port;dbname=$dbName", $dbUser, $dbPass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("<p style='color:red;'>Database connection failed: " . htmlspecialchars($e->getMessage()) . "</p>");
}
