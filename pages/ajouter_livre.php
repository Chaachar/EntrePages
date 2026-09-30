<!DOCTYPE html>
<html lang="fr">

<?php require_once '../config/init.php';?>
<?php $erreurs=$_SESSION["erreurs"] ?? [];
$validation_livre = $_SESSION["validation_livre"] ?? null;
unset($_SESSION["erreurs"]);?>
<?php require '../includes/head.php'; ?>
<body>
    <?php require '../includes/header.php';?>
    <section class="inscription">
        <h2> Ajouter mon livre </h2>
        <form action="../traitements/recherche_livre.php" method="post">
            <label class="inscription-label" for="isbn">Par ISBN</label>  
            <input type="text" class="inscription-champ" name="isbn" id="isbn" required>
            <em> Le numéro ISBN, c'est le numéro à coté du code barre</em>
            <input type="hidden" name="type_recherche" value="isbn">
            <button type="submit" class="btn-1" > Rechercher </button>
        </form> 
    </section>
    <?php if(!empty($erreurs)): ?>
        <div class="bloc-erreurs">
                <?php foreach($erreurs as $erreur): ?>
                    <p class="erreurs-m"><?= htmlspecialchars($erreur) ?></p>
                <?php endforeach;?>
            </div>
    <?php endif;?>
    
        <?php if($validation_livre !== null && empty($erreurs)):?>
        <section class="inscription">
            <h2> Est-ce le bon livre ? </h2>
            <p><h3>Titre : </h3><?= htmlspecialchars($validation_livre["titre"])?></p>
            <p><h3> Auteur : </h3><?= htmlspecialchars($validation_livre["auteur"])?></p>
            <p><h3>ISBN : </h3><?= htmlspecialchars($validation_livre["isbn"])?></p>
            <?php if($validation_livre["resume"] !== null):?>
                <p><h3>Résumé : </h3><?= htmlspecialchars($validation_livre["resume"])?></p>
            <?php endif;?>
            <?php if($validation_livre["url_couverture"] !==null) :?>
                <img src="<?= htmlspecialchars($validation_livre["url_couverture"])?>" alt="Couverture du livre">
            <?php endif;?>
            <form action="../traitements/recherche_livre.php" method="post">
                <input type="hidden" name="action" value="valider_livre">
                <button type="submit" class="btn-1" > Ajouter </button>
            </form>
        </section>    
        <?PHP endif;?>
    
    <?php require '../includes/footer.php'; ?>

</body>

</html>