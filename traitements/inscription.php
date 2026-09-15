<?php require_once '../config/init.php';?>

<?php session_start();
$nom=$_POST["nom"];
$prenom=$_POST["prenom"];
$pseudo=$_POST["pseudo"];
$email=$_POST["email"];
$mot_de_passe=$_POST["mot_de_passe"];
$erreurs=[];

if(empty($nom)){
    $erreurs[]="Le nom est obligatoire.";
}
elseif(!preg_match('/^[\p{L} \'-]+$/u',$nom)){
    $erreurs[]="Le nom n'est pas valide.";
}
if(empty($prenom)){
    $erreurs[]="Le prénom est obligatoire.";
}
elseif(!preg_match('/^[\p{L} \'-]+$/u',$prenom)){
    $erreurs[]="Le prénom n'est pas valide.";
}

if(empty($pseudo)){
    $erreurs[]="Le pseudo est obligatoire.";
}
elseif(!preg_match('/^[0-9\p{L}_-]+$/u',$pseudo)){
    $erreurs[]="Le pseudo n'est pas valide.";
}

if(empty($email)){
    $erreurs[]="L'adresse mail est obligatoire.";
} elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $erreurs[]="L'adresse mail n'est pas valide.";
}

if(empty($mot_de_passe)){
    $erreurs[]="Le mot de passe est obligatoire.";
}
elseif(strlen($mot_de_passe) < 6){
    $erreurs[]="Le mot de passe doit au moins contenir 6 caractères.";
}

if(empty($erreurs)){
    $mot_de_passe_hash=password_hash($mot_de_passe,PASSWORD_DEFAULT);
    $requete=$pdo->prepare("INSERT INTO utilisateur(nom,prenom,pseudo,email,mot_de_passe,photo_profil) VALUES (:nom,:prenom,:pseudo,:email,:mot_de_passe,:photo_profil)");
    try{
    $requete->execute([":nom"=>$nom,":prenom"=>$prenom,":pseudo"=>$pseudo,":email"=>$email,":mot_de_passe"=>$mot_de_passe_hash,":photo_profil"=>NULL]);      
        header("location: ../pages/profil.php");
        exit;
    }catch(PDOException $e){
        $message=$e->errorInfo[2];
            if(str_contains($message,'email_unique')){
                $erreurs[]="L'adresse mail existe déjà !";
            }
            if(str_contains($message,'pseudo_unique')){
                $erreurs[]="Le pseudo est déjà pris !";
            }

            $_SESSION["erreurs"]=$erreurs;
            header("location: ../pages/inscription.php");
            exit;}   
}else{
    $_SESSION["erreurs"]=$erreurs;
    header("location: ../pages/inscription.php");
    exit;
}

?> 




