<!DOCTYPE html>
<html lang="fr">

<!-- Projet : EntrePages
Nom fichier : index.php
Dernière mise à jour : 07.07.26
version v0.1.0
-->
    
    <?php include 'includes/head.php'; ?>
    
    <body>
        <?php include 'includes/header.php';?>

        <main>
            <section>
                <h2>Présentation</h2>
                <p> C'est une communauté de lecteurs qui partagent leurs livres et leurs expériences de lecture. Vous trouverez les fonctionnalités suivantes :</p>
                <img src="assets/img/X" alt="bibliothèque">
                    <ul>
                        <li>Ajouter un livre</li>
                        <li>Partager votre bibliothèque</li>
                        <li>Emprunter ceux des autres</li>
                    </ul>
            </section>

            <section>
                <h2>Découvrez un profil utilisateur</h2>
                <?php include'includes/profil_utilisateur.php'; ?>
            </section>

            <section>
                <h2>Les derniers livres ajoutés</h2>
                <?php include 'includes/carte_livre.php'; ?>
                <?php include 'includes/carte_livre.php'; ?>
                <?php include 'includes/carte_livre.php'; ?>
            </section>
        </main>

        <?php include 'includes/footer.php'; ?>
    </body>
    
</html>