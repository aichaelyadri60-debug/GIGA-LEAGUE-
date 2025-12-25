<?php

interface CrudInterface {
    public function create(object $entity);
    public function findAll(): array;
}
