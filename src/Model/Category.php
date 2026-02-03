<?php

namespace App\Model;

use PDO;
use App\Model\DB;


class Category
{
    public ?int $id = null;
    public string $name = '';

    public static function findAll(): array
    {
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM category ORDER BY id DESC');
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($row) {
            $c = new self();
            $c->id = (int)$row['id'];
            $c->name = (string)$row['name'];
            return $c;
        }, $rows);
    }

    public static function findOne(int $id): ?self
    {
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM category WHERE id = :id');
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        $c = new self();
        $c->id = (int)$row['id'];
        $c->name = (string)$row['name'];
        return $c;
    }

    public function save(): void
    {
        $pdo = DB::getConnection();

        if ($this->id === null) {
            $stmt = $pdo->prepare('INSERT INTO category (name) VALUES (:name)');
            $stmt->execute(['name' => $this->name]);
            $this->id = (int)$pdo->lastInsertId();
            return;
        }

        $stmt = $pdo->prepare('UPDATE category SET name = :name WHERE id = :id');
        $stmt->execute(['name' => $this->name, 'id' => $this->id]);
    }

    public static function delete(int $id): void
    {
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare('DELETE FROM category WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}