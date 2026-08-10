<!DOCTYPE html>
<html lang="fr">

<?php require_once '../config/init.php';?>
<?php $erreurs=$_SESSION["erreurs"] ?? [];
unset($_SESSION["erreurs"]);?>

<?php require '../includes/head.php'; ?>
<body>
    <?php require '../includes/header.php';?>
        <h1 class="bonjour"> Salut ! </h1>
        <div class="inscription-erreur">
        <section class="inscription">
            <form action="../traitements/connexion.php" method="post">
                <label class="inscription-label">Identifiant <br> psst.. c'est votre adresse mail</label>
                <input type="email" class="inscription-champ" name="email" required>
                <label class="inscription-label">Mot de passe</label>
                <input type="password" class="inscription-champ" name="mot_de_passe" required>
                <button type="submit" class="btn-1" > Connexion </button>
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