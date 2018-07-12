<?php
/**
 * @file Chat.php
 *
 * @author Fabien TAVERNIER <contact@monkfish.fr>
 */

class Chat
{
    /**
     * @var array
     */
    private static $cats_list = [];

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $age;

    /**
     * @var string
     */
    private $color;

    /**
     * @var string
     */
    private $sex;

    /**
     * @var array
     */
    private $sexes = ['mâle', 'femelle'];

    /**
     * @var string
     */
    private $breed;

    /**
     * Chat constructor.
     *
     * @param string $name
     * @param int $age
     * @param string $color
     * @param string $sex
     * @param string $breed
     * @throws ChatException
     * @throws Exception
     */
    public function __construct(string $name, int $age, string $color,
                                string $sex, string $breed)
    {
        if (strlen($name) > 2 && strlen($name) <= 20) {
            $this->setName($name);
        } else {
            throw new ChatException('Le nom pour ' . $name . ' doit comporter entre 3 et 20 caractères', __CLASS__, __LINE__);
        }

        if (is_int($age)) {
            $this->setAge($age);
        } else {
            throw new ChatException('L\âge de ' . $name . ' doit être indiqué en chiffre (nombre d\'années)', __CLASS__, __LINE__);
        }

        if (strlen($color) > 2 && strlen($color) <= 10) {
            $this->setColor($color);
        } else {
            throw new ChatException('La couleur de ' . $name . ' doit comporter entre 3 et 10 caractères', __CLASS__, __LINE__);
        }

        if (in_array($sex, $this->sexes)) {
            $this->setSex($sex);
        } else {
            throw new ChatException('Le sexe de ' . $name . ' doit être "mâle" ou "femelle"', __CLASS__, __LINE__);
        }

        if (strlen($breed) > 2 && strlen($breed) <= 20) {
            $this->setBreed($breed);
        } else {
            throw new ChatException('La race de ' . $name . ' doit comporter entre 3 et 20 caractères', __CLASS__, __LINE__);
        }
    }

    /**
     * @return array
     */
    public function getInfos(): array
    {
        return [
            'name' => $this->getName(),
            'age' => $this->getAge(),
            'color' => $this->getColor(),
            'sex' => $this->getSex(),
            'breed' => $this->getBreed(),
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @throws Exception
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return integer
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param integer $age
     * @throws Exception
     */
    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     * @throws Exception
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getSex(): string
    {
        return $this->sex;
    }

    /**
     * @param string $sex
     * @throws Exception
     */
    public function setSex(string $sex): void
    {
        $this->sex = $sex;
    }

    /**
     * @return string
     */
    public function getBreed(): string
    {
        return $this->breed;
    }

    /**
     * @param string $breed
     * @throws Exception
     */
    public function setBreed(string $breed): void
    {
        $this->breed = $breed;
    }

    /**
     * @return array
     */
    public static function getCats()
    {
        return self::$cats_list;
    }

    /**
     * @param string $name
     * @param int $age
     * @param string $color
     * @param string $sex
     * @param string $breed
     * @return Chat
     * @throws ChatException
     */
    public static function addCat(string $name, int $age, string $color,
                                  string $sex, string $breed): Chat
    {
        $cat = new Chat($name, $age, $color, $sex, $breed);
        self::$cats_list[$name] = $cat->getInfos();

        return $cat;
    }
}
