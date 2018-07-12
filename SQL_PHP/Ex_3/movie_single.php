<?php
/**
 * @file movie_single.php
 * User: Monkfish
 * Date: 12/06/2018
 * Time: 13:29
 */

require_once 'config/settings.php';
require_once 'class/autoload.php';

$head_title = 'Zoom to...';
$page = 'movies_list';

$Validation = new \Monkfish\Validation();
$get = $Validation->sanitize($_GET);

if (!empty($get['id']) && $Validation->isInt($get['id'])) {
    $Movie = new \Monkfish\Movie();
    $movie = $Movie->one($get['id']);

    if (!$movie) {
        header("Location: " . ROOT_URL . "/error404.php");
        exit();
    }
} else {
    http_response_code(403);
    die('Forbidden - Miss parameters in URL');
}
?>

<?php require 'partials/header.php'; ?>

<h1><?= $movie->title ?>
    <small>(<?= $movie->year_of_prod ?> - <?= $movie->language ?>)</small>
</h1>

<div class="category">
    <span><?= $movie->category ?></span>
</div>

<div class="clearfix">
    <div class="col-left">
        <iframe src="<?= $movie->video ?>" frameborder="0" width="720"
                height="405"></iframe>

        <p><small>link: <a href="<?= $movie->video ?>"><?= $movie->video
                ?></a></small></p>
    </div>

    <div class="col-right">
        <p>
            Directed by <?= $movie->director ?><br>
            Produced by <?= $movie->producer ?><br>
        </p>

        <h2>Casting</h2>

        <ul>
        <?php foreach (explode(', ', $movie->actors) as $actor) : ?>
            <li><?= $actor ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
</div>

<div>
    <p><?= $movie->storyline ?></p>
</div>

<?php require 'partials/footer.php' ?>
