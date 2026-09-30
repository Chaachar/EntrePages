<?php $page = basename($_SERVER["PHP_SELF"]);?>
<header>
    <div class="brand">
        <div class="logo">
            <img src="<?= BASE_URL ?>assets/img/EP_logo_couleur.png" alt="logo EntrePages">
        </div>
        <div class="brand-text">
            <h1>EntrePages</h1>
            <p><em>Votre bibliothèque ouverte aux autres</em></p>
        </div>
        
    </div>

<?php if($page === "deconnexion.php" || $page === "demande_emprunt.php"):?>
<?php elseif ($page === "modification_profil.php"||$page==="ajouter_livre.php"):?>
    <nav>
        <a href="<?= BASE_URL ?>pages/profil.php" class="btn">Mon profil</a>
    </nav>
<?php elseif (isset($_SESSION["id_utilisateur"])):?>
    <nav>
        <a href="<?= BASE_URL ?>pages/modification_profil.php" class="btn">Modifier mon profil</a>
        <a href="<?= BASE_URL ?>pages/deconnexion.php" class="btn">Déconnexion</a>
    </nav>
<?php elseif($page === "inscription.php"):?>
    <nav>
        <ul>
            <li><a href="<?= BASE_URL ?>pages/connexion.php" class="btn">Connexion</a></li>
        </ul>
    </nav>
<?php elseif($page === "connexion.php"):?>
    <nav>
        <ul>
            <li><a href="<?= BASE_URL ?>pages/inscription.php" class="btn">Inscription</a></li>
        </ul>
    </nav>

<?php else :?>    
    <nav>
        <ul>
            <li><a href="<?= BASE_URL ?>pages/inscription.php" class="btn">Inscription</a></li>
            <li><a href="<?= BASE_URL ?>pages/connexion.php" class="btn">Connexion</a></li>
        </ul>
    </nav>
<?php endif ?>    


</header>
