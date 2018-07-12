<?php
/**
 * @file treatment.php
 * User: Monkfish
 * Date: 12/06/2018
 * Time: 15:07
 */
$success = false;

if ($_POST) {
    $data = [];
    $errors = [];

    $min_chars = 5;

    $Validation = new \Monkfish\Validation();
    $post = $Validation->sanitize($_POST);

    if (!empty($post['title'])) {
        if ($Validation->isLongerThan($post['title'], $min_chars)) {
            $data['title'] = $post['title'];
        } else {
            $errors['title'] = 'the <b>title</b> must contain at least ' .
                $min_chars . ' letters';
        }
    } else {
        $errors['title'] = 'the <b>title</b> is required';
    }

    if (!empty($post['actors'])) {
        if ($Validation->isLongerThan($post['actors'], $min_chars)) {
            $data['actors'] = $post['actors'];
        } else {
            $errors['actors'] = 'the <b>actors</b> must contain at least ' .
                $min_chars . ' letters';
        }
    } else {
        $errors['actors'] = 'the <b>actors</b> is required';
    }

    if (!empty($post['director'])) {
        if ($Validation->isLongerThan($post['director'], $min_chars)) {
            $data['director'] = $post['director'];
        } else {
            $errors['director'] = 'the <b>director</b> must contain at least ' .
                $min_chars . ' letters';
        }
    } else {
        $errors['director'] = 'the <b>director</b> is required';
    }

    if (!empty($post['producer'])) {
        if ($Validation->isLongerThan($post['producer'], $min_chars)) {
            $data['producer'] = $post['producer'];
        } else {
            $errors['producer'] = 'the <b>producer</b> must contain at least ' .
                $min_chars . ' letters';
        }
    } else {
        $errors['producer'] = 'the <b>producer</b> is required';
    }

    if (!empty($post['year'])) {
        $data['year'] = $post['year'];
    } else {
        $errors['year'] = 'the <b>year of production</b> is required';
    }

    if (!empty($post['language'])) {
        $data['language'] = $post['language'];
    } else {
        $errors['language'] = 'the <b>language</b> is required';
    }

    if (!empty($post['category'])) {
        /* Get the ENUM() values for the categories */
        $instance = \Monkfish\DataBase::getInstance();
        $categories = $instance->getEnumValues('movies', 'category');

        if (in_array($post['category'], $categories)) {
            $data['category'] = $post['category'];
        } else {
            $errors['category'] = 'the <b>category</b> does not exist';
        }
    } else {
        $errors['category'] = 'the <b>category</b> is required';
    }

    if (!empty($post['storyline'])) {
        if ($Validation->isLongerThan($post['storyline'], $min_chars)) {
            $data['storyline'] = $post['storyline'];
        } else {
            $errors['storyline'] = 'the <b>storyline</b> must contain at least ' .
                $min_chars . ' letters';
        }
    } else {
        $errors['storyline'] = 'the <b>storyline</b> is required';
    }

    if (!empty($post['video'])) {
        if ($Validation->isURL($post['video'])) {
            $data['video'] = $post['video'];
        } else {
            $errors['video'] = 'the <b>video</b> must be a valid URL';
        }
    } else {
        $data['video'] = 'the <b>video</b> is required';
    }

    if (empty($errors)) {
        $Movie = new \Monkfish\Movie();
        $insert = $Movie->add($data);

        if ($insert['success']) {
            $success = $insert['msg'];
        } else {
            $errors['insert'] = $insert['msg'];
        }
    }

}
