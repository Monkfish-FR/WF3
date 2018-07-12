<?php
/**
 * @file settings.php
 * User: Monkfish
 * Date: 12/06/2018
 * Time: 14:07
 */

/**
 * Path constants
 */
$protocol = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';

define('DOMAIN_NAME', $_SERVER['HTTP_HOST']);
define('DOMAIN_PATH', '/Ex_3/');

define('ROOT_URL', $protocol . DOMAIN_NAME . DOMAIN_PATH);
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . DOMAIN_PATH);

define('CSS_URL', ROOT_URL . 'css/');

/**
 * Connexion data
 */
// Database access
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_BASE', 'exercice_3');
define('DB_USER', 'root');
define('DB_PASS', '');
