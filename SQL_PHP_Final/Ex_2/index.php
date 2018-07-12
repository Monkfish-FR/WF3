<?php

require_once 'connect.php';

define('ROOT_URL', 'http://localhost:8000/Ex_2/');

if (!empty($_POST)) {
    $post = [];
    $errors = [];

    foreach ($_POST as $key => $value) {
        $post[$key] = strip_tags(trim($value));
    }

    if (empty($post['gender'])) {
        $errors[] = 'La civilité doit être renseignée';
    } elseif (!in_array($post['gender'], ['Mlle', 'Mme', 'M'])) {
        $errors[] = 'La civilité doit être choisie parmi la liste proposée';
    }

    if (empty($post['firstname'])) {
        $errors[] = 'Le prénom doit être renseigné';
    } elseif (strlen($post['firstname']) < 3) {
        $errors[] = 'Le prénom doit comporter au moins 3 caractères';
    }

    if (empty($post['lastname'])) {
        $errors[] = 'Le nom doit être renseigné';
    } elseif (strlen($post['lastname']) < 3) {
        $errors[] = 'Le nom doit comporter au moins 3 caractères';
    }

    if (empty($post['email'])) {
        $errors[] = 'L\'adresse e-mail doit être renseignée';
    } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'L\'adresse email est invalide';
    }

    if (empty($post['birthdate'])) {
        $errors[] = 'La date de naissance doit être complétée';
    } elseif (!preg_match('/^([1-9][0-9]{3})(-([0-9]{2}){2})$/', $post['birthdate'])) {
        $errors[] = 'La date de naissance doit être dans le format AAAA-MM-JJ';
    }

    if (empty($post['city'])) {
        $errors[] = 'La ville ne peut être vide';
    }

    if (count($errors) === 0) {
        // Il n'y a pas d'erreur, on ajoute l'utilisateur en base de données
        $stmt = 'INSERT INTO users (gender, firstname, lastname, email, birthdate, city)
            VALUES(:gender, :firstname, :lastname, :email, :birthdate, :city)';

        $insertUser = $db->prepare($stmt);
        $insertUser->bindValue(':gender', $post['gender'], PDO::PARAM_STR);
        $insertUser->bindValue(':firstname', $post['firstname'],
            PDO::PARAM_STR);
        $insertUser->bindValue(':lastname', $post['lastname'], PDO::PARAM_STR);
        $insertUser->bindValue(':email', $post['email'], PDO::PARAM_STR);
        $insertUser->bindValue(':birthdate', date('Y-m-d', strtotime($post['birthdate'])), PDO::PARAM_STR);
        $insertUser->bindValue(':city', $post['city'], PDO::PARAM_STR);

        if ($insertUser->execute()) {
            $createUser = true;
        } else {
            $errors[] = 'Erreur SQL';
        }
    }
}

$users = null;
$order = '';

if (isset($_GET['column']) && isset($_GET['order'])) {
    if ($_GET['column'] == 'lastname') {
        $order = ' ORDER BY lastname';
    } elseif ($_GET['column'] == 'firstname') {
        $order = ' ORDER BY firstname';
    } elseif ($_GET['column'] == 'birthdate') {
        $order = ' ORDER BY birthdate';
    }

    if ($_GET['order'] == 'asc') {
        $order .= ' ASC';
    } elseif ($_GET['order'] == 'desc') {
        $order .= ' DESC';
    }
}

$queryUsers = $db->prepare('SELECT * FROM users' . $order);
if ($queryUsers->execute()) {
    $users = $queryUsers->fetchAll();
}
?><!DOCTYPE html>
<html>
<head>
  <title>Exercice 1</title>
  <meta charset="utf-8">
  <link
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
      rel="stylesheet">
</head>
<body>

<div class="container">

  <h1>Liste des utilisateurs</h1>

  <p>Trier par :
    <a href="<?= ROOT_URL ?>index.php?column=firstname&order=asc">Prénom
      (croissant)
    </a> |
    <a href="<?= ROOT_URL ?>index.php?column=firstname&order=desc">Prénom
      (décroissant)</a> |
    <a href="<?= ROOT_URL ?>index.php?column=lastname&order=asc">Nom
      (croissant)</a> |
    <a href="<?= ROOT_URL ?>index.php?column=lastname&order=desc">Nom
      (décroissant)
    </a> |
    <a href="<?= ROOT_URL ?>index.php?column=birthdate&order=desc">Âge
      (croissant)</a> |
    <a href="<?= ROOT_URL ?>index.php?column=birthdate&order=asc">Âge
      (décroissant)</a>
  </p>
  <br>

  <div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php if (isset($createUser) && $createUser === true) : ?>
          <div class="alert alert-success">
            Le nouvel utilisateur a été ajouté avec succès.
          </div>
        <?php elseif (!empty($errors)) : ?>
          <div class="alert alert-danger">
        <?= implode('<br>', $errors) ?>
      </div>
        <?php endif; ?>
    </div>
    <br>

    <div class="col-md-7">
      <table class="table">
        <thead>
        <tr>
          <th>Civilité</th>
          <th>Prénom</th>
          <th>Nom</th>
          <th>Email</th>
          <th>Age</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($users as $user): ?>
          <tr>
            <td><?= $user['gender'] ?></td>
            <td><?= $user['firstname'] ?></td>
            <td><?= $user['lastname'] ?></td>
            <td><?= $user['email'] ?></td>
            <td>
                <?= DateTime::createFromFormat('Y-m-d', $user['birthdate'])
                    ->diff(new DateTime('now'))
                    ->y ?>
              ans
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="col-md-5">
      <form method="post" class="form-horizontal well well-sm">
        <fieldset>
          <legend>Ajouter un utilisateur</legend>

          <div class="form-group">
            <label class="col-md-4 control-label" for="gender">Civilité</label>
            <div class="col-md-8">
              <select id="gender" name="gender" class="form-control input-md"
                      required>
                <option value="Mlle">Mademoiselle</option>
                <option value="Mme">Madame</option>
                <option value="M">Monsieur</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="firstname">Prénom</label>
            <div class="col-md-8">
              <input id="firstname" name="firstname" type="text"
                     class="form-control input-md" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="lastname">Nom</label>
            <div class="col-md-8">
              <input id="lastname" name="lastname" type="text"
                     class="form-control input-md" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="email">Email</label>
            <div class="col-md-8">
              <input id="email" name="email" type="email"
                     class="form-control input-md" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="city">Ville</label>
            <div class="col-md-8">
              <input id="city" name="city" type="text"
                     class="form-control input-md" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="birthdate">Date de
              naissance</label>
            <div class="col-md-8">
              <input id="birthdate" name="birthdate" type="text"
                     placeholder="JJ-MM-AAAA" class="form-control input-md"
                     required>
              <span class="help-block">au format JJ-MM-AAAA</span>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
              <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>
</body>
</html>
