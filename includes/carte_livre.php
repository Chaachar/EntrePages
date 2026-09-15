<?php require_once 'config/init.php';?>
<?php $resultat=$pdo->("SELECT * FROM livre");
        $livre=$resultat->fetchall(PDO::FETCH_ASSOC); ?>
<article class="book"> 
    <div class="book-img">
        <img class="book-cover" src="<?= BASE_URL ?>assets/img/demo_livre.png" alt="couverture du livre">
    </div>

    <div class="book-info">
        <h3 class="book-title"><em><?= $livre["titre"] ?></em></h3>
        <p class="book-author"><?= $livre["auteur"]?></p>
        <p class="book-resume"><?= $livre["resume"]?></p>
        <p class="book-add-by"> Ajouté par ... </p>
    </div>

</article>
