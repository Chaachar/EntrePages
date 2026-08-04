<!DOCTYPE html>
<html lang="fr">

<!-- Projet : EntrePages
Nom fichier : index.php
Dernière mise à jour : 27.07.26
version v0.1.1
-->
    <?php require_once 'config/database.php'; ?>
    <?php require 'includes/head.php'; ?>
    
    <body>
        <?php require 'includes/header.php';?>

        <main>
            <div class="hero">
                <section>
                    <h2 class="presentation-h2">Présentation</h2>
                    <div class="presentation-content">
                        <div class="presentation-text">
                            <p class="presentation-text-p"> C'est une communauté de lecteurs qui partagent leurs livres et leurs expériences de lecture. Vous trouverez les fonctionnalités suivantes :</p>
                            <ul class="presentation-text-ul">
                                <li>Ajouter un livre</li>
                                <li>Partager votre bibliothèque</li>
                                <li>Emprunter ceux des autres</li>
                            </ul>
                        </div>

                        <div class="presentation-img">
                            <img class="presentation-img"src="assets/img/bibli_a.jpg" alt="bibliothèque"> 
                        </div>
                    </div>
                </section>
                <section class="presentation-profil">
                    <h2 class="presentation-profil-titre">Découvrez un profil utilisateur</h2>
                    <?php require 'includes/profil_utilisateur.php'; ?>
                </section>
            </div>

            <section class="book-added">
                <h2>Les derniers livres ajoutés</h2>
                <div class="book-list">
                    <?php $resultat=$pdo->query("SELECT * FROM exemplaire ORDER BY id_exemplaire DESC LIMIT 3");
                    $exemplaires = $resultat->fetchAll(PDO::FETCH_ASSOC);
                    if (empty($exemplaires)){
                        echo "<p>Aucun livre n'a encore été ajouté.</p>";
                    };
                    foreach($exemplaires as $exemplaire){
                        require 'includes/carte_livre.php';
                    }; ?>
                </div>
            </section>
        </main>

        <?php require 'includes/footer.php'; ?>
    </body>
    
</html>