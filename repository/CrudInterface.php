<?php

interface CrudInterface {
    public function create(object $entity):bool;
    public function findAll(): array;
    public function delete(object $entity): bool;
    public function findOne(int $id): ?object;
    
}
