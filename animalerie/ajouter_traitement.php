<?php

// Connexion a la BDD
require 'database.php';

if(isset($_POST['libelle']) && isset($_POST['quantite_minimale']) && isset($_POST['quantite_en_stock']))
{

    // Inserer les donnees dans la bdd
    $bdd = Database::connect();
    $req = $bdd->prepare('INSERT INTO produit (libelle, quantite_minimale, quantite_en_stock) VALUES(?,?,?)');
    $req->execute(array($_POST['libelle'], $_POST['quantite_minimale'], $_POST['quantite_en_stock']));

    header('Location:index1.php');
}


?>