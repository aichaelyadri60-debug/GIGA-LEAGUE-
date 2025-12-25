<?php

class EquipeRepository extends BaseRepository implements CrudInterface {

    protected string $table = 'equipe';
    protected string $entityClass = Equipe::class;
}
