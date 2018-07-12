<?php
/**
 * @file movies_list.php
 * User: Monkfish
 * Date: 12/06/2018
 * Time: 13:29
 */

require_once 'config/settings.php';
require_once 'class/autoload.php';

$head_title = 'All the movies';
$page = 'movies_list';

$Movie = new \Monkfish\Movie();
$movies = $Movie->all(['id', 'title', 'director', 'year_of_prod']);
?>

<?php require 'partials/header.php'; ?>

<h1>All the movies</h1>
<!-- @todo CSS -->
<table border="1">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Director</th>
        <th>Year of production</th>
        <th>Action</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($movies as $movie) : ?>
        <tr>
            <td><?= $movie->id ?></td>
            <td><?= $movie->title ?></td>
            <td><?= $movie->director ?></td>
            <td><?= $movie->year_of_prod ?></td>
            <td><a class="view" href="<?= ROOT_URL ?>movie_single.php?id=<?=
                $movie->id ?>">View</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require 'partials/footer.php' ?>
