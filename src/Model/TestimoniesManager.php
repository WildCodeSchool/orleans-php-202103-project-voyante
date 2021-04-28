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
    /**
     * Update item in database
     */
    public function update(array $item): bool
    {
        $query = "UPDATE " . self::TABLE . " SET 'name'=:name, 'mail'=:mail, 
                'message'=:message, 'validation'=:validation WHERE id=:id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $item['name'], \PDO::PARAM_STR);
        $statement->bindValue('mail', $item['mail'], \PDO::PARAM_STR);
        $statement->bindValue('message', $item['message'], \PDO::PARAM_STR);
        $statement->bindValue('validation', $item['validation'], \PDO::PARAM_BOOL);

        return $statement->execute();
    }
}
