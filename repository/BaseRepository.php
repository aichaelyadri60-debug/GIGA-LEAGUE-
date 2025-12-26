<?php  
require_once "./repository/CrudInterface.php";
abstract class BaseRepository implements CrudInterface
{
    protected PDO $conn;
    protected string $table;
    protected string $entityClass;

    public function __construct(PDO $pdo)
    {
        $this->conn = $pdo;
    }

    public function create(object $entity): bool
    {
        $ref = new ReflectionClass($entity);
        $props = $ref->getProperties();

        $fields = [];
        $params = [];
        $data   = [];

        foreach ($props as $prop) {
            $prop->setAccessible(true);
            $name = $prop->getName();

            if ($name === 'id') continue;

            $fields[] = $name;
            $params[] = ':' . $name;
            $data[$name] = $prop->getValue($entity);
        }

        $sql = "INSERT INTO {$this->table} (" . implode(',', $fields) . ")
                VALUES (" . implode(',', $params) . ")";

        return $this->conn->prepare($sql)->execute($data);
    }

public function delete(int $id): bool
{
    $sql = "DELETE FROM {$this->table} WHERE id = :id";
    return $this->conn->prepare($sql)->execute(['id' => $id]);
}


    public function findAll(): array
    {
        $stmt = $this->conn->query("SELECT * FROM {$this->table}");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($rows as $row) {
            $entity = new $this->entityClass();
            $entity->hydrate($row);
            $result[] = $entity;
        }
        return $result;
    }

    public function findOne(int $id): ?object
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        $entity = new $this->entityClass();
        $entity->hydrate($row);
        return $entity;
    }

    public function update(object $entity): bool
    {
        $ref = new ReflectionClass($entity);
        $props = $ref->getProperties();

        $set = [];
        $data = [];
        $id = null;

        foreach ($props as $prop) {
            $prop->setAccessible(true);
            $name = $prop->getName();
            $value = $prop->getValue($entity);

            if ($name === 'id') {
                $id = $value;
                continue;
            }

            $set[] = "$name = :$name";
            $data[$name] = $value;
        }

        $data['id'] = $id;

        $sql = "UPDATE {$this->table} SET " . implode(',', $set) . " WHERE id = :id";
        return $this->conn->prepare($sql)->execute($data);
    }
}
