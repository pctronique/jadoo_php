<?php 

include_once '../class/Connect_SGBD.php';

$sgbd = new Connect_SGBD();
$sgbd->connect();

if(!empty($_POST)) {

    $res = $sgbd->prepare("INSERT INTO messages(Nom, Prenom, Email, Message) VALUES ".
    "(:Nom,:Prenom,:Email,:Message)");
    $res->execute([
        ":Nom" => trim(stripslashes(htmlspecialchars($_POST['name']))),
        ":Prenom" => trim(stripslashes(htmlspecialchars($_POST['first_name']))),
        ":Email" => trim(stripslashes(htmlspecialchars($_POST['mail']))),
        ":Message" => trim(stripslashes(htmlspecialchars($_POST['user_text']))),
    ]);
    
    echo "le message a été envoyé.";
} else {
    echo "Vous ne pouvez pas utiliser cette page.";
}

?>