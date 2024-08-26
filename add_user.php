<?php
include 'connect.php';

$data = json_decode(file_get_contents('php://input'), true);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
    $stmt->execute([$data['username'], $data['email'], $data['password']]);
    
    echo 'User added successfully';
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}