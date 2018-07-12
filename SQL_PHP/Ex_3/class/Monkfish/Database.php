<?php
/**
 * DataBase class - design pattern singleton
 *
 * Usage :
 * <pre>
 *     private $cnx; // connexion variable
 *     $db = DataBase::getInstance();
 *     $this->cnx = $db->getPDO();
 * </pre>
 *
 * @link http://php.net/manual/en/book.pdo.php PDO class
 */

namespace Monkfish;

use PDO;
use PDOException;

/**
 * Class Database
 * @package Monkfish
 */
class Database
{

    /**
     * DataBase class instance
     * @access private
     * @static
     * @var Database
     * @link getInstance
     */
    private static $instance = null;

    /**
     * Database type
     * @access private
     * @var string
     * @link __construct
     */
    private $db_type = DB_TYPE;

    /**
     * Database host
     * @access private
     * @var string
     * @link __construct
     */
    private $db_host = DB_HOST;

    /**
     * Database name
     * @access private
     * @var string
     * @link __construct
     */
    private $db_name = DB_BASE;

    /**
     * Database username
     * @access private
     * @var string
     * @link __construct
     */
    private $db_user = DB_USER;

    /**
     * Database user password
     * @access private
     * @var string
     * @link __construct
     */
    private $db_pwd = DB_PASS;

    /**
     * PDO object
     * @var PDO object
     * @link __construct
     */
    private $pdo;

    /**
     * DataBase class constructor
     *
     * Run database connexion and stock it in the $pdo variable
     * @access private
     * @param void
     */
    private function __construct()
    {
        try {
            $this->pdo = new PDO(
                $this->db_type . ':host=' . $this->db_host . ';dbname=' . $this->db_name . ';charset=UTF8',
                $this->db_user,
                $this->db_pwd,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_PERSISTENT => true,
                ]
            );


        } catch (PDOException $e) {
            echo '<div>Error! ' . $e->getMessage() . '</div>';
            die();
        }
    }

    /**
     * If an instance exists, return it ; else create a new one
     * @access public
     * @static
     * @param void
     * @return Database
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Get the PDO object to manipulate the database
     * @access public
     * @param void
     * @return PDO
     */
    public function getPDO()
    {
        return $this->pdo;
    }

    /**
     * get the values allowed in an ENUM field
     * @param string $table The name of the table in the database
     * @param string $field The ENUM() field
     * @return array The values
     */
    function getEnumValues($table, $field): array
    {
        $query = $this->pdo->query("SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'");
        $type = $query->fetch()->Type;

        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);

        return explode("','", $matches[1]);
    }

}
