<?php

namespace App\Model;

class TestimoniesManager extends AbstractManager
{
    public const TABLE = 'testimony';

    /**
     * Insert new testimony in database
     */
    //`id`, `name`, `mail`, `message`, `validation`

    public function insert(array $testimony): int
    {
        $query = "INSERT INTO " . self::TABLE . "(`name`, `mail`, `message`, `validation`) 
                VALUES (:name, :mail, :message, :validation)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $testimony['name'], \PDO::PARAM_STR);
        $statement->bindValue('mail', $testimony['mail'], \PDO::PARAM_STR);
        $statement->bindValue('message', $testimony['message'], \PDO::PARAM_STR);
        $statement->bindValue('validation', $testimony['validation'], \PDO::PARAM_BOOL);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
    /**
     * Update testimony in database
     */
    public function update(array $testimony): bool
    {
        $query = "UPDATE " . self::TABLE . " SET 'name'=:name, 'mail'=:mail, 
                'message'=:message, 'validation'=:validation WHERE `id`=:id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $testimony['name'], \PDO::PARAM_STR);
        $statement->bindValue('mail', $testimony['mail'], \PDO::PARAM_STR);
        $statement->bindValue('message', $testimony['message'], \PDO::PARAM_STR);
        $statement->bindValue('validation', $testimony['validation'], \PDO::PARAM_BOOL);
        $statement->bindValue('id', $testimony['id'], \PDO::PARAM_INT);

        return $statement->execute();
    }
    /**
     * Update testimony in database
     */
    public function updateStatus(bool $status, int $id): bool
    {
        $query = "UPDATE " . self::TABLE . " SET `validation`=:validation WHERE `id`=:id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('validation', $status, \PDO::PARAM_BOOL);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        return $statement->execute();
    }
}
