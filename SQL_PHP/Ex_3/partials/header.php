<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $head_title ?> | MyMovies</title>
    <link rel="stylesheet" href="<?= CSS_URL ?>app.css">
</head>

<body>
<header class="clearfix">
    <h1><a href="<?= ROOT_URL ?>"><span>my</span>Movies</a></h1>

    <nav>
        <ul>
            <li>
                <a href="<?= ROOT_URL ?>movie_add.php"
                   class="<?= $page == 'movie_add' ? 'active' : '' ?>">Add a
                    movie</a>
            </li>
            <li>
                <a href="<?= ROOT_URL ?>movies_list.php"
                   class="<?= $page == 'movies_list' ? 'active' : '' ?>">The
                    movies</a>
            </li>
        </ul>
    </nav>
</header>

<main>
