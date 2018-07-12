<?php
/**
 * @file error404.php
 * User: Monkfish
 * Date: 11/06/2018
 * Time: 18:05
 */

require_once 'config/settings.php';

$head_title = '404';
$page = 'error404';
?>
<?php require 'partials/header.php'; ?>
</header>

<main>
    <h1>Page not found</h1>

    <ul>
        <li>
            <a href="<?= ROOT_URL ?>movie_add.php">Add a movie</a>
        </li>
        <li>
            <a href="<?= ROOT_URL ?>movies_list.php">The movies</a>
        </li>
    </ul>
</main>

<?php require 'partials/footer.php' ?>
