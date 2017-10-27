<?php

// BDD
$pdo = new PDO('mysql:host=localhost;dbname=tchat', 'root', '', array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
));

// SESSION
session_start();

// VARIABLE
$msg = '';
?>
