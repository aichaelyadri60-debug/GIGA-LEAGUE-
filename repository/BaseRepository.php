<?php  

abstract class BaseRepository {

    protected PDO $conn;
    protected string $table;
    protected string $entityClass;

    public function __construct() {
        $this->conn = require __DIR__ . '/../config/db.php';
    }

    public function create(object $entity): bool {
        $ref = new ReflectionClass($entity);
        $props = $ref->getProperties();
        $names = [];
        $params = [];
        $data = [];

        foreach ($props as $prop) {
            $prop->setAccessible(true);
            $name = $prop->getName();

            if ($name === 'id') continue;

            $names[] = $name;
            $params[] = ':' . $name;
            $data[$name] = $prop->getValue($entity);
        }

        $sql = "INSERT INTO {$this->table} (" . implode(',', $names) . ")
                VALUES (" . implode(',', $params) . ")";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete(object $entity): bool {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'id' => $entity->getId()
        ]);
    }

    public function findAll(): array {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $entities = [];
        foreach ($rows as $row) {
            $entity = new $this->entityClass();
            $entity->hydrate($row);
            $entities[] = $entity;
        }
        return $entities;
    }
}
