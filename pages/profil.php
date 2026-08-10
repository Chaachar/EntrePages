<!DOCTYPE html>
<html lang="fr">

<?php require_once '../config/init.php';?>
<?php if(!isset($_SESSION["id_utilisateur"])){
    header("location: ../index.php");
    exit;
    } ?>

<?php require '../includes/head.php'; ?>
<body>
    <?php require '../includes/header.php';?>
    
    <?php require '../includes/footer.php'; ?>

</body>

</html>