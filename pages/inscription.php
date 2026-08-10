<!DOCTYPE html>
<html lang="fr">

<?php require_once '../config/init.php';?>
<?php require '../includes/head.php'; ?>
<?php $erreurs=$_SESSION["erreurs"] ?? [];
unset($_SESSION["erreurs"]);?>

<body>
    <?php require '../includes/header.php';?>
    <h1 class="bonjour"> Salut ! </h1>
        <div class="inscription-erreur">
        <section class="inscription">
            <form action="../traitements/inscription.php" method="post">
                <label class="inscription-label">Nom</label>
                <input type="text" class="inscription-champ" name="nom" required>
                <label class="inscription-label">Prénom</label>
                <input type="text" class="inscription-champ" name="prenom" required>
                <label class="inscription-label">Pseudo</label>
                <input type="text" class="inscription-champ" name="pseudo" required>
                <label class="inscription-label">Adresse email</label>
                <input type="email" class="inscription-champ" name="email" required>
                <label class="inscription-label">Mot de passe</label>
                <input type="password" class="inscription-champ" name="mot_de_passe" required>
                <label class="inscription-label">Une photo ? </label>
                <input type="file" class="inscription-champ-photo" name="photo" enctype="multipart/form-data">
                <button type="submit" class="btn-1" > Je m'inscris </button>
            </form>    
        </section>
        <?php if(!empty($erreurs)): ?>
            <div class="bloc-erreurs">
                <?php foreach($erreurs as $erreur): ?>
                    <p class="erreurs-m"><?= htmlspecialchars($erreur) ?></p>
                <?php endforeach;?>
            </div>
        <?php endif;?>
        </div>    

    <?php require '../includes/footer.php'; ?>

</body>

</html>
