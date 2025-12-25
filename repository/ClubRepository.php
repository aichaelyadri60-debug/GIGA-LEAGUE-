<?php

class ClubRepository extends BaseRepository implements CrudInterface {

    protected string $table = 'club';
    protected string $entityClass = Club::class;
}
