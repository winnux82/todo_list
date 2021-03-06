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
    <title>ToDo List</title>
</head>

<body>

    <table>
        <tr>
            <td><img src="todo.png" /></td>
            <td>
                <h1>To-do List</h1>
            </td>
        <tr>
            <td>
                <!-- Si la position est nulle, c'est un ajout -->
                <?php if ($position === null) : ?>
                    <h3>Add</h3>
                    <!-- Sinon c'est une édition -->
                <?php else : ?>
                    <h3>Edit</h3>
                <?php endif ?>
            </td>
        </tr>
        <form action="save.php<?= $url ?>" method="POST">
            <table>
                <tr>
                    <td></td>
                    <td><input type="text" name="nom" value="<?= $donnees['nom'] ?? '' ?>" required maxlength="50" pattern="[a-zA-Z0-9-_àéè^ôù$]+"><br></td>
                    <td><input type="submit" class="btn btn-primary" value="<?php //si ajouter ou modifier
                                                                            if ($position === null) : ?> Add<?php else : ?>Edit<?php endif ?>">
                </tr>
            </table>
        </form>
        <?php

        //Liste des non complete


        echo '<table class="table table-responsive w-50 d-block d-md-table">';
        echo '<tr><th>Name</th><th>Completed</th><th>Edit</th><th>Remove</th>';
        if (isset($_SESSION['donnees'])) {
            //on crée le foreach pour la liste

            if (empty($_SESSION['donnees'])) echo '<tr><td colspan="4">Empty list</td></tr>';
            foreach ($_SESSION['donnees'] as $position => $data) {
                if ($data['check'] == 0) {


                    //on donne la liste des données
                    echo '<tr>';
                    //echo '<td>' . $position . ' </td> '
                    if ($data['check'] == 0) {
                        echo '<td width="50%">' . htmlspecialchars($data['nom']) . '</td>';
                    } else {
                        echo '<td width="50%"><s>' . htmlspecialchars($data['nom']) . '</s></td>';
                    }
                    //echo '<td>' . $data['check'] . '</td>';
                    echo '&nbsp;';
                    $url = '?position=' . $position; ?>
                    <td>
                        <form action="save.php<?= $url ?>" method="POST">
                            <input type="hidden" name="nom" value="<?= $data['nom'] ?? '' ?>">
                            <?php if ($data['check'] == 0) {
                                //on définit la variable $checked
                                $checked = 'unchecked';
                            } else {
                                $checked = 'checked';
                            } ?>
                            <input type="checkbox" name="check" <?= $checked ?> value="1">
                            <input type="submit" value="Complete" <?php // on modifie la couleur du bouton
                                                                    if ($checked == 'checked') : ?> class="btn btn-success" <?php else : ?> class="btn btn-warning" <?php endif ?>>
                    </td>
                    </form>
                <?php
                    //Bouton modifier
                    echo '<td><a href="index.php?position=' . $position . '"> <input type="submit" value="Edit" class="btn btn-secondary"> </a></td>';
                    echo '&nbsp;';

                    //Bouton supprimer 
                    echo '<td><a onclick="return confirm(\'Voulez vous vraiment supprimer cet élément?\')" href="supprimer.php?position=' . $position . '"> <input type="submit" value="Delete" class="btn btn-danger"> </a></td>';
                    echo '</tr>';
                }
            }
            echo '</table>';
        }
        echo '<H3>Completed</h3>';
        //Liste des completes
        echo '<table class="table table-responsive w-50 d-block d-md-table">';
        echo '<tr><th>Name</th><th>Completed</th><th>Edit</th><th>Remove</th>';
        if (isset($_SESSION['donnees'])) {
            //on crée le foreach pour la liste

            if (empty($_SESSION['donnees'])) echo '<tr><td colspan="4">Empty list</td></tr>';
            foreach ($_SESSION['donnees'] as $position => $data) {
                if ($data['check'] == 1) {


                    //on donne la liste des données
                    echo '<tr>';
                    //echo '<td>' . $position . ' </td> '
                    if ($data['check'] == 0) {
                        echo '<td width="50%">' . htmlspecialchars($data['nom']) . '</td>';
                    } else {
                        echo '<td width="50%"><s>' . htmlspecialchars($data['nom']) . '</s></td>';
                    }
                    //echo '<td>' . $data['check'] . '</td>';
                    echo '&nbsp;';
                    $url = '?position=' . $position; ?>
                    <td>
                        <form action="save.php<?= $url ?>" method="POST">
                            <input type="hidden" name="nom" value="<?= $data['nom'] ?? '' ?>">
                            <?php if ($data['check'] == 0) {
                                //on définit la variable $checked
                                $checked = 'unchecked';
                            } else {
                                $checked = 'checked';
                            } ?>
                            <input type="checkbox" name="check" <?= $checked ?> value="1">
                            <input type="submit" value="Complete" <?php // on modifie la couleur du bouton
                                                                    if ($checked == 'checked') : ?> class="btn btn-success" <?php else : ?> class="btn btn-warning" <?php endif ?>>
                    </td>
                    </form>
        <?php
                    //Bouton modifier
                    echo '<td><a href="index.php?position=' . $position . '"> <input type="submit" value="Edit" class="btn btn-secondary"> </a></td>';
                    echo '&nbsp;';

                    //Bouton supprimer 
                    echo '<td><a onclick="return confirm(\'Voulez vous vraiment supprimer cet élément?\')" href="supprimer.php?position=' . $position . '"> <input type="submit" value="Delete" class="btn btn-danger"> </a></td>';
                    echo '</tr>';
                }
            }
            echo '</table>';
        }


        ?>
</body>

</html>