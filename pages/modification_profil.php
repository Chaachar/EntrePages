<!DOCTYPE html>
<html lang="fr">

<?php require_once '../config/init.php';?>
<?php if(!isset($_SESSION["id_utilisateur"])){
    header("location: ../index.php");
    exit;
    } ?>
<?php $erreurs=$_SESSION["erreurs"] ?? [];
    $messages=$_SESSION["messages"] ?? [];
unset($_SESSION["erreurs"]);
unset($_SESSION["messages"]);?>

<?php require '../includes/head.php'; ?>
<body>
    <?php require '../includes/header.php';?>
    <?php if(!empty($erreurs)): ?>
        <div class="bloc-erreurs">
            <?php foreach($erreurs as $erreur): ?>
                <p class="erreurs-m"><?= htmlspecialchars($erreur) ?></p>
                <?php endforeach;?>
            </div>
    <?php endif?>
    <?php if(!empty($messages)):?>
        <div class="bloc-messages">
            <?php foreach($messages as $message): ?>
                <p class="message-m"><?= htmlspecialchars($message) ?></p>
            <?php endforeach;?>
        </div>
    <?php endif;?>

    <div class="modification-page">
    <section class="modification">
        <h3 class="modif-titre"> Mes informations privées</h2>
        <form action="../traitements/modification_profil.php" method="post">
            <label class="inscription-label">Nom</label>
            <input type="text" class="inscription-champ" name="nom">

            <label class="inscription-label">Prénom</label>
            <input type="text" class="inscription-champ" name="prenom">
            
            <label class="inscription-label">Adresse email</label>
            <input type="email" class="inscription-champ" name="email">
                
            <label class="inscription-label">Mot de passe</label>
            <input type="password" class="inscription-champ" name="mot_de_passe">
    </section>
    <section class="modification">    
        <h3 class="modif-titre"> Mes informations publiques</h2>
            <label class="inscription-label">Pseudo</label>
            <input type="text" class="inscription-champ" name="pseudo">
            
            <label class="inscription-label">Description</label>
            <input type="text" class="modification-champ" name="description">
                
            <label class="inscription-label">Citation</label>
            <input type="text" class="modification-champ" name="citation">

            <label class="inscription-label">Une photo</label>
            <input type="file" class="inscription-champ-photo" name="photo" enctype="multipart/form-data">
    </section>
    </div>
            <div class="btn-validation"><button type="submit" class="btn-1" > Je modifie </button></div>
        </form>    
    
    <?php require '../includes/footer.php'; ?>

</body>

</html>