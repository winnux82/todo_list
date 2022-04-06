<?php
//on initialise la session
session_start();
//on initialise tout 
$url = '';
$position = null;
$donnees = [];
//si une position existe
if (isset($_GET['position'])) {
    $position = $_GET['position'];
    //on lui définit $donnees avec la position $_GET
    $donnees = $_SESSION['donnees'][$position];
    $url = '?position=' . $position;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <!-- Si la position est nulle, c'est un ajout -->
    <?php if ($position === null) : ?>
        <h1>Ajout</h1>
        <!-- Sinon c'est une édition -->
    <?php else : ?>
        <h1>Edition</h1>
    <?php endif ?>

    <form action="save.php<?= $url ?>" method="POST">
    <table>
            <tr>
                <td>Nom : </td>
                <td><input type="text" name="nom" value="<?= $donnees['nom'] ?? '' ?>"><br></td>
                <td><input type="submit" value="Ajouter" class="btn btn-primary"></td>
            </tr>
        </table>

    </form>


    <?php

    //Liste
    echo '<h1>To-do List</h1>';
    echo '<table class="table">';
    if (isset($_SESSION['donnees'])) {
        //on crée le foreach pour la liste

        if (empty($_SESSION['donnees'])) echo "Le tableau est vide";
        foreach ($_SESSION['donnees'] as $position => $data) {
        //on donne la liste des donnes
        echo '<tr>';
        echo '<td>' . $position . ' </td> ';
        echo '<td>' . $data['nom'] . ' </td>';
        echo '</Tr>';

            echo '<td><a href="index.php?position=' . $position . '"> <input type="submit" value="Modifier"> </a></td>';
            echo '&nbsp;';


        //Bouton supprimer 
        echo '<td><a onclick="return confirm(\'Voulez vous vraiment supprimer cet élément?\')" href="supprimer.php?position=' . $position . '"> <input type="submit" value="Supprimer" class="btn btn-danger"> </a></td>';
        echo '</tr>';
    }
    echo '</table>';
    ?>

</body>

</html>