<?php
/**
 * @file index.php
 *
 * @author Fabien TAVERNIER <contact@monkfish.fr>
 */

require_once 'Chat.php';
require_once 'ChatException.php';

$Olive = Chat::addCat('Olive', 11, 'tigrée', 'femelle', 'Tigré européen');

$Daphnee = Chat::addCat('Daphnée', 8, 'blanche', 'femelle', 'Chat de gouttière');

$Nino = Chat::addCat('Nino', 4, 'gris', 'mâle', 'Chat de gouttière');

$Cats = Chat::getCats();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mes chats</title>
    <link
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
        rel="stylesheet">
</head>
<body>

<div class="container">
    <header>
        <h1>Mes chats</h1>
    </header>

    <main>
    <?php foreach ($Cats as $cat) : ?>
        <h2><?= $cat['name'] ?></h2>

        <table class="table table-bordered">
            <thead>
                <th>Âge</th>
                <th>Couleur</th>
                <th>Sexe</th>
                <th>Race</th>
            </thead>
            <tbody>
            <tr>
                <td><?= $cat['age'] ?> ans</td>
                <td><?= $cat['color'] ?></td>
                <td><?= $cat['sex'] ?></td>
                <td><?= $cat['breed'] ?></td>
            </tr>
            </tbody>
        </table>
    <?php endforeach; ?>
    </main>

    <footer>&copy; 2018 - Fabien TAVERNIER</footer>
</div>
</body>
</html>
