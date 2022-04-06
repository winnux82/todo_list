<?php

//on lance session
session_start();
//on initialise la position
$position = null;
//on importe la position avec $_GET
if (isset($_GET['position'])) {
    $position = $_GET['position'];
}

$data = $_POST;

if (isset($data['nom']) === false || empty($data['nom'])) {
    echo 'Le nom est obligatoire';
    echo "<a href='index.php'>Retour au formulaire</a>";
    exit;

}

//  Création du tableau donnees s'il n'existe pas
if (isset($_SESSION['donnees']) === false) {
    $_SESSION['donnees'] = [];}

//ajout d'une donnees à notre tableau donnee
//Si la position n'est pas nulle, on modifie la donnee position avec la variable $donnees qui est rempli de $_POST
if ($position !== null) {
    $_SESSION['donnees'][$position] = $data;
//Si position est nulle, on ajoute la donnee
} else {
    $_SESSION['donnees'][] = $data;
}

//on redirige vers le fichier liste.php
header('location: index.php');
exit;
