<?php
//on initialise la session
session_start();

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
    <form action="save.php" method="POST">
        <table>
            <td>Nom:</td>
            <td><input type="text" name="nom" value=""></td>
            <td><input type="submit" value="Ajouter"></td>


        </table>

    </form>


    <?php

    //Liste
    echo '<h1>To-do List</h1>';
    echo '<table class="table">';

    foreach ($_SESSION['donnees'] as $position => $data) {
        //on donne la liste des donnes
        echo '<tr>';
        echo '<td>' . $position . ' </td> ';
        echo '<td>' . $data['nom'] . ' </td>';
        echo '</Tr>';



        //Bouton supprimer 
        echo '<td><a onclick="return confirm(\'Voulez vous vraiment supprimer cet élément?\')" href="supprimer.php?position=' . $position . '"> <input type="submit" value="Supprimer" class="btn btn-danger"> </a></td>';
        echo '</tr>';
    }
    echo '</table>';
    ?>

</body>

</html>