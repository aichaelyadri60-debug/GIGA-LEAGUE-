<?php

interface CrudInterface {
    public function create(object $entity):bool;
    public function findAll(): array;
    public function delete(int $id): bool;
    public function findOne(int $id): ?object;
    
}
