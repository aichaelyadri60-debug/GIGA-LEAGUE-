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
    public function findOne(int $id):?object{
        $sql ="SELECT * FROM {$this->table} WHERE id=?";
        $stmt =$this->conn->prepare($sql);
        $stmt->execute([$id]);
        $result =$stmt->fetch(PDO::FETCH_ASSOC);
        if(!$result)return null;
        $entity=new $this->entityClass();
        $entity->hydrate($result);
        return $entity ;
    }

    public function update(object $entity):bool
    {
        $ref -new ReflectionClass($entity);
        $Props =$ref->getProperties();
        $set  = [];
        $data = [];
        $id   = null;
        foreach($props as $prop){
            $key =$ref->fgetName();
            $value =$ref->getValue($entity);
            if($key ==='id'){
                $id =$value;
                continue;
            }
            $set[]="$key=:$key";
            $data[$key]=$value;
        }
        $data['id']=$id;
        $sql ="UPDATE {$this->table}  SET(".implode(',' ,$set).") WHERE id=$id";
        $stmt =$this->pdo->prepare($sql);
        return $stmt->execute($data);

    }
}
