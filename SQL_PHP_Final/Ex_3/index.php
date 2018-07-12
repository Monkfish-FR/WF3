<?php
/**
 * @file index.php
 *
 * @author Fabien TAVERNIER <contact@monkfish.fr>
 */

define('ROOT_URL', 'http://localhost:8000/Ex_3/');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Exercice 3</title>
  <link
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
      rel="stylesheet">
  <style>
    .error { color: #c0445f; }
  </style>
</head>
<body>
<div class="container">
  <header>
    <h1>Ajouter un véhicule</h1>
  </header>

  <main>
    <form id="addVehicle" method="post" class="form-horizontal well well-sm">
      <div class="form-group">
        <label class="col-md-2 control-label" for="brand">
          Marque
        </label>
        <div class="col-md-10">
          <input id="brand" name="brand" type="text"
                 class="form-control input-md">
        </div>
        <div class="col-md-10 col-md-offset-2 error error-brand"></div>
      </div>

      <div class="form-group">
        <label class="col-md-2 control-label" for="model">
          Modèle
        </label>
        <div class="col-md-10">
          <input id="model" name="model" type="text"
                 class="form-control input-md">
        </div>
        <div class="col-md-10 col-md-offset-2 error error-model"></div>
      </div>

      <div class="form-group">
        <label class="col-md-2 control-label" for="year">
          Année
        </label>
        <div class="col-md-10">
          <input id="year" name="year" type="text"
                 class="form-control input-md" placeholder="AAAA">
        </div>
        <div class="col-md-10 col-md-offset-2 error error-year"></div>
      </div>

      <div class="form-group">
        <label class="col-md-2 control-label" for="color">
          Couleur
        </label>
        <div class="col-md-10">
          <select id="color" name="color" class="form-control input-md">
            <option value="" hidden selected>Sélectionnez une couleur&hellip;
            </option>
            <option value="white">Blanche</option>
            <option value="blue">Bleue</option>
            <option value="yellow">Jaune</option>
            <option value="black">Noire</option>
            <option value="red">Rouge</option>
            <option value="green">Verte</option>
          </select>
        </div>
        <div class="col-md-10 col-md-offset-2 error error-color"></div>
      </div>

      <div class="form-group">
        <div class="col-md-4 col-md-offset-2">
          <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
      </div>
    </form>
  </main>

  <footer>&copy; 2018 - Fabien TAVERNIER</footer>
</div>

<script src="<?= ROOT_URL ?>js/app.js"></script>

</body>
</html>
