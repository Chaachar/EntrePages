<?php require_once 'config/init.php';?>
<article class="book"> 
    <div class="book-img">
        <?php if(empty($livre["url_couverture"])) :?>
            <p> Il n'y a malheureusement pas de couverture... </p>
        <?php else: ?>
            <img class="book-cover" src="<?= htmlspecialchars($livre["url_couverture"])?>" alt="Couverture de <?= htmlspecialchars(($livre["titre"]))?>">
        <?php endif;?>
    </div>

    <div class="book-info">
        <h3 class="book-title"><em><?= htmlspecialchars($livre["titre"])?></em></h3>
        <p class="book-author"><?= htmlspecialchars($livre["auteur"])?></p>
        <?php if(empty($livre["resume"])): ?>
            <p> Mince, il n'y a pas de résumé</p>
        <?php else: ?>
            <p class="book-resume"><?= htmlspecialchars($livre["resume"])?></p>
        <?php endif; ?>
        <p class="book-add-by"> Ajouté par ... </p>
    </div>
</article>
