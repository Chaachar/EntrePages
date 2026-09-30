<?php require_once '../config/init.php';
require_once '../config/api.php';

$id_use=$_SESSION["id_utilisateur"];
$recherche=[];
$erreurs=[];
foreach($_POST as $key => $value){
    $recherche[$key]=$value;
}

function normaliser_isbn($isbn){
    $isbn = preg_replace('/[ -]/', '', $isbn);
    $longueur = strlen($isbn);
    //ISBN-13
    if ($longueur === 13) {
        if (!preg_match('/^[0-9]{13}$/', $isbn)) {
            return false;
        }
        $somme = 0;
        for ($i = 0; $i < 12; $i++) {
            if ($i % 2 === 0) {
                $somme += (int)$isbn[$i];
            } else {
                $somme += (int)$isbn[$i] * 3;
            }
        }
        $cle = (10 - ($somme % 10)) % 10;
        if ($cle !== (int)$isbn[12]) {
            return false;
        }
        return $isbn;
    }
    // ISBN-10
    elseif ($longueur === 10) {
        if (!preg_match('/^[0-9]{9}[0-9X]$/', $isbn)) {
            return false;
        }
        // Conversion ISBN-10 → ISBN-13
        $isbn13_sans_cle = '978' . substr($isbn, 0, 9);
        $somme = 0;
        for ($i = 0; $i < 12; $i++) {
            if ($i % 2 === 0) {
                $somme += (int)$isbn13_sans_cle[$i];
            } else {
                $somme += (int)$isbn13_sans_cle[$i] * 3;
            }
        }
        $cle = (10 - ($somme % 10)) % 10;
        return $isbn13_sans_cle . $cle;
    }
    else {
        return false;
    }
}
if($recherche["action"]!="valider_livre"){
$isbn=normaliser_isbn($recherche["isbn"] ?? "");
if ($isbn === false){
    $erreurs[]="Le format de l'ISBN n'est pas valide";
    $_SESSION["erreurs"]=$erreurs;
    header("location: ../pages/ajouter_livre.php");
    exit;
}
$url="https://www.googleapis.com/books/v1/volumes?q=isbn:" . urlencode($isbn) ;
$curl = curl_init($url);
curl_setopt_array($curl,[CURLOPT_RETURNTRANSFER => true, CURLOPT_HTTPHEADER => ['X-Goog-Api-Key: '.GOOGLE_BOOKS_API_KEY,'Accept: application/json'], CURLOPT_TIMEOUT => 10]);
$response = curl_exec($curl);
$httpCode = curl_getinfo($curl,CURLINFO_HTTP_CODE);
$curlError = curl_error($curl);
$donnees=json_decode($response, true); 

//Affichage pour comprendre les données renvoyées par l'API GoogleBooks
//print_r($donnees);
//echo "Code HTTP : ".$httpCode."\n";
//echo "Erreur cURL : ".$curlError."\n";
//echo "Réponse :\n";
//echo $response;
//echo "</pre>";

if($donnees["totalItems"] === 0){
    $erreurs[]="Le livre n'a pas été trouvé";
    $_SESSION["erreurs"]=$erreurs;
    header("location: ../pages/ajouter_livre.php");
    exit;
}
$volumeInfo = $donnees["items"][0]["volumeInfo"];

$livre=["isbn"=> $isbn, "titre"=>$volumeInfo["title"],"auteur"=>$volumeInfo["authors"][0], "resume"=>$volumeInfo["description"] ?? null, "url_couverture" => $volumeInfo["imageLinks"]["thumbnail"] ?? null];
$_SESSION["validation_livre"]=$livre;
header("location: ../pages/ajouter_livre.php");
exit;
}
else{
    if(!isset($_SESSION["validation_livre"])){
        $erreurs[]="Aucun livre à ajouter...";
        $_SESSION["erreurs"]=$erreurs;
        header("location: ../pages/ajouter_livre");
        exit;
    }

    $validation_livre=$_SESSION["validation_livre"];
    $parametres=[];
    $validation_livre_sql=[];
    $validation_livre_sql_parametre=[];
    try{
        $requete=$pdo->prepare("SELECT isbn FROM livre WHERE isbn = :isbn");
        $requete->execute(["isbn"=>$validation_livre["isbn"]]);
        $resultat=$requete->fetch();
    
        foreach($validation_livre as $key => $value){
            $validation_livre_sql[]="$key";
            $validation_livre_sql_parametre[]=":".$key;
            $parametres[":".$key]=$value;
        }
        if($resultat === false){
            $sql_key=implode(",",$validation_livre_sql);
            $sql_values=implode(",",$validation_livre_sql_parametre);
            $requete=$pdo->prepare("INSERT INTO livre(".$sql_key.") VALUES (".$sql_values.")");
            $requete->execute($parametres);
        }
        
        $requete=$pdo->prepare("INSERT INTO exemplaire(isbn,id_proprietaire) VALUES (:isbn,:id_proprietaire)");
        $requete->execute([":isbn"=>$validation_livre["isbn"],":id_proprietaire"=>$id_use]);
        $messages[]="Le livre ".$validation_livre["titre"]." a bien été ajouté à la bibliothèque commune";
        $_SESSION["messages"]=$messages;
        header("location: ../pages/profil.php");
        exit;}
    catch(PDOException $e){
        $erreurs[]="Une erreur est survenue lors de l'ajout du livre";
        $_SESSION["erreurs"]=$erreurs;
        header("location: ../pages/ajouter_livre.php");
        exit;
    }
}
?>