<!DOCTYPE html>
<html lang="fr">

<?php require_once '../config/init.php';?>
<?php if(!isset($_SESSION["id_utilisateur"])){
    header("location: ../index.php");
    exit;
    } ?>
<?php $messages=$_SESSION["messages"] ?? [];
unset($_SESSION["messages"]);?>    

<?php require '../includes/head.php'; ?>
<body>
    <?php require '../includes/header.php';?>
    <div class="page-profil">
        <section class="profil">
            <h2> Mon profil </h2>
            <?php require '../includes/carte_utilisateur.php';?>
        </section>
        <section class="bibliotheque">
            <?php if(!empty($messages)):?>
                <div class="bloc-messages">
                    <?php foreach($messages as $message): ?>
                    <p class="message-m"><?= htmlspecialchars($message) ?></p>
                    <?php endforeach;?>
                </div>
            <?php endif;?>
            <h2> Bibliothèque commune</h2>
                <nav>
                    <a href="<?= BASE_URL ?>pages/ajouter_livre.php" class="btn-1">Ajouter un livre</a>
                </nav>
        </section>
        <div class="recherche-livre">
            <section class="recherche">
                <h2> Recherche dans la bibliothèque commune</h2>
                <form action="../traitements/recherche_livre.php" method="post">
                    <label class="inscription-label">Par Titre</label>  
                    <input type="text" class="inscription-champ" name="titre" required>
                    <button type="submit" class="btn-1" > Rechercher </button>
                </form> 
            </section>
            <section class="book-added">
                <h2> Livre sélectionné </h2>
                <?php //require '../includes/carte_livre.php';?>
                <nav>
                    <a href="<?= BASE_URL ?>pages/demande_emprunt.php" class="btn-1">Emprunter</a>
                </nav>
            </section>
                
        </div>
    </div>

    <?php require '../includes/footer.php'; ?>

</body>

</html>