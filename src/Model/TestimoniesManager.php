<?php

namespace App\Model;

class TestimoniesManager extends AbstractManager
{
    public const TABLE = 'testimony';

    /**
     * Insert new item in database
     */
    //`id`, `name`, `mail`, `message`, `validation`

    public function insert(array $item): int
    {
        $query = "INSERT INTO " . self::TABLE . "('name', 'mail', 'message', 'validation') 
                VALUES (:name, :mail, :message, :validation)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $item['name'], \PDO::PARAM_STR);
        $statement->bindValue('mail', $item['mail'], \PDO::PARAM_STR);
        $statement->bindValue('message', $item['message'], \PDO::PARAM_STR);
        $statement->bindValue('validation', $item['validation'], \PDO::PARAM_BOOL);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
