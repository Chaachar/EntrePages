<?php require_once '../config/init.php';

$id_use=$_SESSION["id_utilisateur"];
$modification=[];
$modification_sql=[];
$erreurs=[];
$messages=[];
$champs_autorises=["nom","prenom","pseudo","email","mot_de_passe","description","citation"];
foreach( $_POST as $key => $value){
    if(in_array($key,$champs_autorises)){  
        if(!empty($value)){   
            if($key=="description" || $key=="citation"){
                $valide=true;
            } 
            if($key == "mot_de_passe"){
                $valide=true;
                if(strlen($value) < 6){
                    $erreurs[]="Le mot de passe doit au moins contenir 6 caractères.";
                    $valide = false;
                } else{
                    $value=password_hash($value,PASSWORD_DEFAULT);
                }
            }
            if($key=="nom"){
                $valide=true;
                if(!preg_match('/^[\p{L} \'-]+$/u',$value)){
                    $erreurs[]="Le nom n'est pas valide.";
                    $valide = false;
                }
            }
            if($key=="prenom"){
                $valide=true;
                if(!preg_match('/^[\p{L} \'-]+$/u',$value)){
                    $erreurs[]="Le prénom n'est pas valide.";
                    $valide = false;
                }
            }
            if($key=="pseudo"){
                $valide=true;
                if(!preg_match('/^[0-9\p{L}_-]+$/u',$value)){
                    $erreurs[]="Le pseudo n'est pas valide.";
                    $valide = false;
                }
            }
            if($key=="email"){       
                $valide=true;
                if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
                    $erreurs[]="L'adresse mail n'est pas valide.";
                    $valide = false;
                }
            }    
        if($valide){
            $modification[$key] =$value;
            $modification_sql[]="$key = :$key";
            }
        }
    }
}
if(empty($modification)){
    if(empty($erreurs)){
        $erreurs[]="vous n'avez saisi aucune modification !";
        $_SESSION["erreurs"]=$erreurs;
        header("location: ../pages/modification_profil.php");
        exit;
    }
}

if(empty($erreurs)){
    $sql=implode(", ",$modification_sql);
    $requete=$pdo->prepare("UPDATE utilisateur SET ".$sql." WHERE id_utilisateur = :id_utilisateur ");
    $parametres=[];
    foreach($modification as $key => $value){
        $parametres[":".$key]=$value;
    }
    $parametres[":id_utilisateur"]=$id_use;
    try{
        $requete->execute($parametres);  
        $messages[]="Les modifications ont bien été prises en compte !";
        $_SESSION["messages"]=$messages;
        header("location: ../pages/modification_profil.php");
        exit;
    } catch(PDOException $e){
        $message=$e->errorInfo[2];
        if(str_contains($message,'email_unique')){
                $erreurs[]="L'adresse mail existe déjà !";
        }
        if(str_contains($message,'pseudo_unique')){
                $erreurs[]="Le pseudo est déjà pris !";
        }
        $_SESSION["erreurs"]=$erreurs;
        header("location: ../pages/modification_profil.php");
        exit;}
}else{
    $_SESSION["erreurs"]=$erreurs;
    header("location: ../pages/modification_profil.php");
    exit;
    }
?>
