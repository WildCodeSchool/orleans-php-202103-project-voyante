<?php

namespace App\Model;

class ServicesManager extends AbstractManager
{
    public const TABLE = 'service';
    /**
     * Update item in database
     */
    public function update(array $item): bool
    {
        $query = "UPDATE " . self::TABLE . " SET 'name'=:name, 'description'=:description, 
                'price1hour'=:price1hour, 'price30min'=:price30min WHERE id=:id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $item['name'], \PDO::PARAM_STR);
        $statement->bindValue('description', $item['description'], \PDO::PARAM_STR);
        $statement->bindValue('price1hour', $item['price1hour'], \PDO::PARAM_STR);
        $statement->bindValue('price30min', $item['price30min'], \PDO::PARAM_BOOL);

        return $statement->execute();
    }
}
