<?php


session_start();
//vérifier que la variable position existe, sinon rediriger vers la page index.php
$position = $_GET['position'];


//vérifier que l'élément existe dans le tableau avant de le supprimer puis rediriger vers la page index.php
if(isset($_SESSION['donnees'][$position])) unset($_SESSION['donnees'][$position]);
//Redigirer vers le fichier index.php
header('location: index.php');

exit;