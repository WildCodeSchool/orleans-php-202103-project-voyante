<?php

namespace App\Model;

class TestimoniesManager extends AbstractManager
{
    public const TABLE = 'testimony';

    /**
     * Insert new item in database
     */
    //`id`, `name`, `mail`, `message`, `validation`

    public function insert(array $testimony): int
    {
        $query = 'INSERT INTO ' . self::TABLE . '(`name`, `mail`, `message`, `validation`) 
                VALUES (:name, :mail, :message, :validation)';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $testimony['name'], \PDO::PARAM_STR);
        $statement->bindValue('mail', $testimony['mail'], \PDO::PARAM_STR);
        $statement->bindValue('message', $testimony['message'], \PDO::PARAM_STR);
        $statement->bindValue('validation', $testimony['validation'], \PDO::PARAM_BOOL);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update testimony status in database
     */
    public function updateStatus(bool $status, int $id): bool
    {
        $query = 'UPDATE ' . self::TABLE . ' SET `validation`=:validation WHERE `id`=:id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('validation', $status, \PDO::PARAM_BOOL);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        return $statement->execute();
    }
     /**
     * Select testimony by status true or false in database
     */
    public function selectedOrderValidate(bool $validation): array
    {
        $query = 'SELECT * FROM ' . static::TABLE . ' WHERE validation=:validation';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('validation', $validation, \PDO::PARAM_BOOL);
        $statement->execute();
        return $statement->fetchAll();
    }
}
