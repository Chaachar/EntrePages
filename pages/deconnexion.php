<!DOCTYPE html>
<html lang="fr">

<?php require_once '../config/init.php';
session_destroy();?>

<?php require '../includes/head.php'; ?>
<body>
    <?php require '../includes/header.php';?>
    <section class="deconnexion"> 
        <p> A la prochaine ! </p>
        <nav class="btn-1"><a href="<?= BASE_URL ?>../index.php" >Retour à l'accueil</a></nav>
    </section>
    
    <?php require '../includes/footer.php'; ?>

</body>

</html>