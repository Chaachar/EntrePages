<?php

require_once '../config/init.php';

$email = $_POST["email"];
$mot_de_passe= $_POST["mot_de_passe"];
$erreurs = [];

$requete=$pdo->prepare("SELECT id_utilisateur, email , mot_de_passe FROM utilisateur WHERE email = :email");
$requete->execute(["email"=> $email]);
$identifiant = $requete->fetch(PDO::FETCH_ASSOC);

if(empty($identifiant)){
    $erreurs[]="Le compte n'existe pas ou l'adresse mail est fausse";
    $_SESSION["erreurs"]=$erreurs;
    header("location: ../pages/connexion.php");
    exit;
    }

if(!password_verify($mot_de_passe,$identifiant["mot_de_passe"])){
    $erreurs[]="Le mot de passe est incorrect";
    $_SESSION["erreurs"]=$erreurs;
    header("location: ../pages/connexion.php");
    exit;
}
else{
    $_SESSION["id_utilisateur"]=$identifiant["id_utilisateur"];
    header("location: ../pages/profil.php");
    exit;
}
