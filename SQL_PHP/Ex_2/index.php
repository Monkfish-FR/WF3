<?php
/**
 * @file index.php
 * User: Monkfish
 * Date: 12/06/2018
 * Time: 12:45
 * @param float $amount
 * @param string $from
 */

/**
 * Convert EUR/USD to USD/EUR
 *
 * @param float $amount The amount to convert
 * @param string $to In which currency to convert
 *
 * @return float|string The converted amount (or an error)
 */
function convertCurrency(float $amount, $to = 'USD')
{
    if (!in_array($to, ['EUR', 'USD'])) {
        return 'The requested currency is not permitted. (Choose between USD and EUR)';
    }

    $ratio = 1.085965;

    if ($to == 'EUR') {
        return $amount / $ratio . '&nbsp;' . $to;
    }

    return $to . '&nbsp;' . $amount * $ratio;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ex. 2 | Évaluation pratique PHP</title>
</head>
<body>
<header>
    <h1>On part en voyage</h1>
</header>

<main>
    <?php
    # Change values below #
    $amount = 1;
    $to = 'USD';
    #######################

    $from = $to == 'USD' ? 'EUR' : 'USD';

    echo $amount . '&nbsp;' . $from . ' = ' . convertCurrency($amount, $to);
    ?>
</main>
</body>
</html>
