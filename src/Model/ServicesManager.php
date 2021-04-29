<?php

namespace App\Model;

class ServicesManager extends AbstractManager
{
    public const TABLE = 'service';

    public function insert(array $item): int
    {
        $query = "INSERT INTO " . self::TABLE . "('name', 'description', 'price1hour', 'price30min') 
                VALUES (:name, :description, :price1hour, :price30min)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $item['name'], \PDO::PARAM_STR);
        $statement->bindValue('description', $item['description'], \PDO::PARAM_STR);
        $statement->bindValue('price1hour', $item['price1hour'], \PDO::PARAM_INT);
        $statement->bindValue('price30min', $item['price30min'], \PDO::PARAM_INT);
        return (int)$this->pdo->lastInsertId();
    }

    public function update(array $item): bool
    {
        $query = "UPDATE " . self::TABLE . " SET 'name'=:name, 'description'=:description, 
                'price1hour'=:price1hour, 'price30min'=:price30min WHERE id=:id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $item['name'], \PDO::PARAM_STR);
        $statement->bindValue('description', $item['description'], \PDO::PARAM_STR);
        $statement->bindValue('price1hour', $item['price1hour'], \PDO::PARAM_INT);
        $statement->bindValue('price30min', $item['price30min'], \PDO::PARAM_INT);
        return $statement->execute();
    }
}
