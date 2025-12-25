<?php

class MatchsRepository extends BaseRepository implements CrudInterface{

    protected string $table = 'matchs';
    protected string $entityClass = Matchs::class;
}
