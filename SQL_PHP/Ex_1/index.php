<?php
/**
 * @file index.php
 * User: Monkfish
 * Date: 12/06/2018
 * Time: 12:45
 */
$users = [
    [
        'firstname' => 'Jane',
        'lastname' => 'Smith',
        'address' => '1 rue de la gare',
        'zipcode' => '59000',
        'city' => 'Lille',
        'email' => 'j.smith@mail.me',
        'phone' => '01234568789',
        'birthday' => '1982-10-10',
    ],
    [
        'firstname' => 'John',
        'lastname' => 'Doe',
        'address' => '15 rue de la poste',
        'zipcode' => '62000',
        'city' => 'Arras',
        'email' => 'jdoe@mail.me',
        'phone' => '0234567891',
        'birthday' => '1979-12-03',
    ],
];

function getFrenchDate($date, $from = 'Y-m-d')
{
    $datetime = DateTime::createFromFormat($from, $date);
    // As $from == 'Y-m-d', we can also use: $datetime = new DateTime($date);

    return $datetime->format('d/m/Y');
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ex. 1 | Évaluation pratique PHP</title>

    <style>
        ol > li {
            margin-bottom: 24px;
        }
    </style>
</head>
<body>
<header>
    <h1>On se présente&nbsp;!</h1>
</header>

<main>
    <ol>
        <?php foreach ($users as $user) : ?>
            <li>
                <ul>
                    <?php $size = count($user); ?>
                    <?php foreach ($user as $key => $data) : ?>
                        <?php $sep = $size === 1 ? '.' : '&nbsp;;'; ?>
                        <?php if ($key == 'birthday') {
                            $data = getFrenchDate($data);
                        } ?>
                        <li>
                            <?= ucfirst($key) ?>&nbsp;:
                            <b><?= $data ?></b><?= $sep ?>
                        </li>
                        <?php $size--; ?>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php endforeach; ?>
    </ol>
</main>
</body>
</html>
