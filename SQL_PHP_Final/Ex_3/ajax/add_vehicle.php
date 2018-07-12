<?php
/**
 * @file add_vehicle.php
 *
 * @author Fabien TAVERNIER <contact@monkfish.fr>
 */

/* Ici on inclut les fichiers de classes ou mieux un "Autoload" */
//require_once '../config/settings.php';
//require_once '../class/Database.php';
//require_once '../class/Utils.php';
//require_once '../class/Vehicle.php';

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    $insert = [
        'success' => false,
        'msg' => 'Merci de corriger les erreurs ci-dessous',
    ];

    if (!empty($_POST)) {
        $post = [];
        $errors = [];

        // On nettoie la super globale $_POST
//        $post = \App\Utils::sanitize($_POST);
        // ici on se contente de la fonction strip_tags
        foreach ($_POST as $key => $value) {
            $post[$key] = strip_tags(trim($value));
        }

        // On valide les différents champs
        foreach ($post as $field => $value) {
            if (empty($value)) {
                $errors[$field] = 'Le champ est requis';
            }
        }

        if (!empty($post['year']) && !preg_match('/[0-9]{4}/', $post['year'])) {
            $errors['year'] = 'Le champ date doit être constitué d\'un nombre à 4 chiffres représentant l\'année';
        }

        // S'il n'y a pas d'erreur
        if (count($errors) === 0) {
            // On ajoute le véhicule en base
//            $Vehicle = new \App\Vehicle();
//            $insert = $Vehicle->add($post);
            // ici on simule l'insertion
            $insert = [
                'success' => true,
                'msg' => 'Le véhicule a été ajouté avec succès',
            ];
        } else {
            $insert['errors'] = $errors;
        }
    }

    echo json_encode($insert);
} else {
    die('Forbidden request have been detected.');
}
