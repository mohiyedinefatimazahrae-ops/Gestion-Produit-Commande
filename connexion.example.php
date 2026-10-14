<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=your_database_name", "your_username", "your_password");
    session_start();
    // echo "Connexion réussie";
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}