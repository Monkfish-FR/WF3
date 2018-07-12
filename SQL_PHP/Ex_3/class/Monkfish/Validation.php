<?php
/**
 * Validation class
 *
 * Validate form submitted data.
 *
 * @package Monkfish
 *
 * @author Fabien TAVERNIER <contact@monkfish.fr>
 * @copyright 2017 Monkfish
 * @license http://www.cecill.info/licences/Licence_CeCILL-B_V1-en.txt CeCILL-B
 */

namespace Monkfish;

use \DateTime;

class Validation
{

    /**
     * Validation class constructor
     * @access public
     */
    public function __construct()
    {

    }

    /**
     * Sanitize database inputs
     * @link http://css-tricks.com/snippets/php/sanitize-database-inputs/
     * @param mixed $input The input to sanitize
     * @param string|boolean $isHTML Is the input is HTML (default: FALSE)
     * @return mixed The sanitized input
     */
    public function sanitize($input, $isHTML = false)
    {
        $output = false;

        if (is_array($input)) {
            foreach ($input as $var => $val) {
                $output[$var] = $this->sanitize($val);
            }
        } else {
            if (get_magic_quotes_gpc()) {
                $input = stripslashes($input);
            }

            if (!$isHTML) {
                $input = $this->cleanInput($input);
            }

            $output = trim($input);
        }

        return $output;
    }

    /**
     * Strip tags ans multi-line comments
     * @access public
     * @param string $input The input to clear
     * @return string The cleared input
     *
     * @link sanitize
     */
    public function cleanInput($input)
    {
        $search = [
            '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
        ];

        return preg_replace($search, '', $input);
    }

    /**
     * Replace accents and special characters in a string
     * @param string $input The input to clean
     * @param string $delimiter The delimiter between the words
     * @param boolean $lower Convert case to lower ?
     * @param mixed $replace Characters to replace
     * @return string The cleared input
     */
    public function cleanName($input, $delimiter = '-', $lower = true, $replace = [])
    {
        if (!empty($replace)) {
            $input = str_replace((array)$replace, ' ', $input);
        }

        $output = iconv('UTF-8', 'ASCII//TRANSLIT', $input);
        $output = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $output);
        $output = preg_replace("/[\/_|+ -]+/", $delimiter, trim($output, '-'));

        return ($lower) ? mb_strtolower($output, 'UTF-8') : $output;
    }

    /**
     * Check if an input is an integer
     * @param integer $int The input to test
     * @return boolean Is it matching ?
     */
    public function isInt($int) {
        return preg_match("/^[0-9]+$/", $int);
    }

    /**
     * Check is an e-mail address is valid
     * @param string $email The e-mail address to test
     * @return boolean Is it valid ?
     */
    public function isEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Check is an URL is valid
     * @param string $url The URL to test
     * @return boolean Is it valid ?
     */
    public function isURL($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    /**
     * Check if a string is long enough
     * @param string $str The string to test
     * @param int $min The minimal number of characters
     * @return boolean Is it valid ?
     */
    public function isLongerThan($str, $min)
    {
        return mb_strlen($str) >= $min;
    }

    /**
     * Check if a date is valid
     * @link http://php.net/manual/en/function.checkdate.php checkdate —
     *     Validate a Gregorian date
     * @param string $str The date to test
     * @param string $format The date format (Ymd or dmY)
     * @return boolean Is it valid ?
     */
    public function isDate($str, $format = 'Ymd')
    {
        $date = $this->cleanDate($str);
        $date_Ymd = $format == 'Ymd' ? $date : $this->dateToYYYYMMDD($date,
            $format);

        if (preg_match('/^[0-9]{8}$/', ltrim($date_Ymd, '0'))) {
            $year = substr($date_Ymd, 0, 4);
            $month = substr($date_Ymd, 4, 2);
            $day = substr($date_Ymd, 6);

            return checkdate($month, $day, $year);
        }

        return false;
    }

    /**
     * Check if a date is not in the future
     * @param string $str The date to test
     * @param string $format The current format of the date
     * @return string Is the date not in the future ?
     */
    public function isNoFutureDate($str, $format = 'Ymd')
    {
        $date = $this->cleanDate($str);
        $date_Ymd = $format == 'Ymd' ? $date : $this->dateToYYYYMMDD($date,
            $format);
        $now = date('Ymd');

        return $date_Ymd <= $now;
    }

    /**
     * Remove other characters than numbers in a date
     * @param string $str The date to clean (Y-m-d, d/m/Y, ...)
     * @return string The date
     */
    public function cleanDate($str)
    {
        return preg_replace('/[^0-9]/', '', $str);
    }

    /**
     * Convert a date in "Ymd" format
     * @param string $str The date
     * @param string format The current format of the date
     * @return string The converted date
     */
    public function dateToYYYYMMDD($str, $format = 'dmY')
    {
        $date = $this->cleanDate($str);
        $date = DateTime::createFromFormat($format, $date);

        return $date->format('Ymd');
    }

    /**
     * Convert a date in "dmY" format
     * @param string $str The date
     * @param string $format The current format of the date
     * @return string The converted date
     */
    public function dateToDDMMYYY($str, $format = 'Ymd')
    {
        $date = $this->cleanDate($str);
        $date = DateTime::createFromFormat($format, $date);

        return $date->format('dmY');
    }

}
