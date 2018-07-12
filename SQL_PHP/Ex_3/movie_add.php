<?php
/**
 * @file movie_add.php
 * User: Monkfish
 * Date: 12/06/2018
 * Time: 13:29
 */

require_once 'config/settings.php';
require_once 'class/autoload.php';
require_once 'inc/treatment.php';

$head_title = 'Add a movie';
$page = 'movie_add';

/* Get the ENUM() values for the categories */
$instance = \Monkfish\DataBase::getInstance();
$categories = $instance->getEnumValues('movies', 'category');
?>

<?php require 'partials/header.php'; ?>

<!-- @todo CSS -->
<h1>Add a movie</h1>

<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        <p>Some errors were encountered:</p>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if ($success) : ?>
    <div class="alert alert-success">
        <p><?= $success ?></p>
    </div>
<?php endif; ?>

<form action="" method="post">
    <p>
        <label for="title"
               class="<?= !empty($errors['title']) ? 'error' : '' ?>">
            <span>Title:</span><!--
         --><input type="text" name="title"
                   value="<?= $post['title'] ?? '' ?>">
        </label>
    </p>
    <p>
        <label for="actors"
               class="<?= !empty($errors['actors']) ? 'error' : '' ?>">
            <span>Actors:</span><!--
         --><input type="text" name="actors"
                   value="<?= $post['actors'] ?? '' ?>">
        </label>
        <small>Separate actor's names by a coma (,).</small>
    </p>
    <p>
        <label for="director"
               class="<?= !empty($errors['director']) ? 'error' : '' ?>">
            <span>Director:</span><!--
         --><input type="text" name="director"
                   value="<?= $post['director'] ?? '' ?>">
        </label>
    </p>
    <p>
        <label for="producer"
               class="<?= !empty($errors['producer']) ? 'error' : '' ?>">
            <span>Producer:</span><!--
         --><input type="text" name="producer"
                   value="<?= $post['producer'] ?? '' ?>">
        </label>
    </p>
    <p>
<!--        @todo CSS -->
        <label for="year"
               class="<?= !empty($errors['year']) ? 'error' : '' ?>">
            <span>Year of production:</span><!--
         --><select name="year">
                <option value="_none"<?= empty($_POST['year']) ? ' selected'
                    : '' ?>
                        disabled>Select a production year&hellip;
                </option>
                <!--  Custom date range: 1970-2020 -->
                <?php for ($i = 1970; $i <= 2020; $i++) : ?>
                    <?php $selected = !empty($post['year']) && $post['year']
                    == $i ? ' selected' : ''; ?>
                    <option value="<?= $i ?>"<?= $selected ?>><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </label>
    </p>
    <p>
        <label for="language"
               class="<?= !empty($errors['language']) ? 'error' : '' ?>">
            <span>Language:</span><!--
         --><select name="language">
                <option value="_none"<?= empty($_POST['language']) ? ' selected' : ''
                ?>
                        disabled>Select a language&hellip;
                </option>
                <?php $languages = [
                    'DE' => 'German',
                    'EN' => 'English',
                    'FR' => 'French',
                    'IT' => 'Italian',
                    'SP' => 'Spanish',
                ]; ?>
                <?php foreach ($languages as $code => $language) : ?>
                    <?php $selected = !empty($post['language']) && $post['language']
                    == $code ? ' selected' : ''; ?>
                    <option value="<?= $code ?>"<?= $selected ?>><?= $language
                        ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    </p>
    <p>
        <label for="category"
               class="<?= !empty($errors['category']) ? 'error' : '' ?>">
            <span>Category:</span><!--
         --><select name="category">
                <option value="_none"<?= empty($_POST['category']) ? ' selected' : ''
                ?>
                        disabled>Select a category&hellip;
                </option>
                <?php foreach ($categories as $category) : ?>
                    <?php $selected = !empty($post['category']) && $post['category']
                    == $category ? ' selected' : ''; ?>
                    <option value="<?= $category ?>"<?= $selected ?>><?=
                        $category ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    </p>
    <p>
        <label for="storyline"
               class="<?= !empty($errors['storyline']) ? 'error' : '' ?>">
            <span>Storyline
                :</span><!--
         --><textarea name="storyline" id="" cols="30"
                      rows="10"><?= $post['storyline'] ?? '' ?></textarea>
        </label>
    </p>
    <p>
        <label for="video"
               class="<?= !empty($errors['video']) ? 'error' : '' ?>">
            <span>Trailer:</span><!--
         --><input type="url" name="video"
                   value="<?= $post['video'] ?? '' ?>"
                   placeholder="http://">
        </label>
    </p>
    <p class="action">
        <button name="add">Add the movie</button>
    </p>
</form>

<?php require 'partials/footer.php' ?>
