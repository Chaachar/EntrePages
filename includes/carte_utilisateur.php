
<?php 
        $id_use=$_SESSION["id_utilisateur"];
        $requete=$pdo->prepare("SELECT pseudo, photo_profil, description, citation FROM utilisateur WHERE id_utilisateur= :id_utilisateur");
        $requete->execute(["id_utilisateur"=>$id_use]);
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
        $pseudo=$utilisateur["pseudo"];
        $description=$utilisateur["description"];
        $citation=$utilisateur["citation"];
?>


<article class="profil">
        <img class="profil-photo" src="<?= BASE_URL ?>assets/img/demo_photo_profil.jpg"  alt="photo profil de Chacha">
        <h3 class="profil-pseudo"> <?php echo $pseudo?></h3>
        <?php if(empty($description)): ?>
                <p>Il n'y pas encore de description.</p> 
        <?php else: ?>
                <p class="profil-description"> <?php echo $description?> </p>
        <?php endif ?>
        
        <p class="profil-nb-livres"> Bibliothèque : 15</p>
        <?php if(empty($citation)): ?>
                <p>Il n'y pas encore de citation préférée.</p> 
        <?php else: ?>
                <p class="profil-citation"> <?php echo $citation?></p>
        <?php endif ?>
</article>