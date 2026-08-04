<?php
//Paramètres de connexion
$host = "localhost";
$dbname="entrepages";
$username="root";
$password="";

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username,$password,
     [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
} catch (PDOexception $e){
    //Enregistre l'erreur dans les logs
    error_log($e->getMessage());
    //Message affiché à l'utilisateur
    die("Une erreur est survenue. Merci de réessayer plus tard.");
}