<?php

namespace Monkfish;


use PDO;
use PDOException;

class Movie
{

    /**
     * Movie constructor.
     */
    public function __construct()
    {
    }

    public function add($data)
    {
        $insert = [];
        $insert['success'] = false;

        try {
            $instance = DataBase::getInstance();
            $pdo = $instance->getPDO();

            $result = $pdo->prepare("INSERT INTO movies (title, actors, director, producer, year_of_prod, `language`, category, storyline, video) VALUES (:title, :actors, :director, :producer, :year, :language, :category, :storyline, :video)");

            $result->bindValue(':title', $data['title'], PDO::PARAM_STR);
            $result->bindValue(':actors', $data['actors'], PDO::PARAM_STR);
            $result->bindValue(':director', $data['director'], PDO::PARAM_STR);
            $result->bindValue(':producer', $data['producer'], PDO::PARAM_STR);
            $result->bindValue(':year', $data['year'], PDO::PARAM_INT);
            $result->bindValue(':language', $data['language'], PDO::PARAM_STR);
            $result->bindValue(':category', $data['category'], PDO::PARAM_STR);
            $result->bindValue(':storyline', $data['storyline'], PDO::PARAM_STR);
            $result->bindValue(':video', $data['video'], PDO::PARAM_STR);

            $execute = $result->execute();

            if ($execute) {
                $insert['success'] = true;
                $insert['msg'] = 'The movie was created with success.';
                $insert['id'] = $pdo->lastInsertId();
            } else {
                $insert['msg'] = 'An error occurs during the request execution.';
            }
        } catch (PDOException $e) {
            $insert['msg'] = $e->getMessage();
        }

        return $insert;
    }

    /**
     * Get all data of a table
     * @access public
     * @param string|array $fields The fields of the table
     * @return object[] The table's data
     */
    public function all($fields = '*') {
        $fields = is_array($fields) ? implode(', ', $fields) : $fields;

        $instance = DataBase::getInstance();
        $pdo = $instance->getPDO();

        $result = $pdo->prepare("SELECT $fields FROM movies ORDER BY year_of_prod DESC");
        $result->execute();

        $data = $result->fetchAll();

        $result->closeCursor();

        return $data;
    }

    /**
     * Get a row's data according its ID
     * @access public
     * @param integer $id The row's ID
     * @param string|array $fields The fields of the table
     * @return object The row's data
     */
    public function one($id, $fields = '*') {
        $fields = is_array($fields) ? implode(', ', $fields) : $fields;

        $instance = DataBase::getInstance();
        $pdo = $instance->getPDO();

        $result = $pdo->prepare("SELECT $fields FROM movies WHERE id = ? LIMIT 1");
        $result->execute([$id]);

        $data = $result->fetch();

        $result->closeCursor();

        return $data;
    }
}
