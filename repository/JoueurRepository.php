<?php

class JoueurRepository extends BaseRepository implements CrudInterface{

    protected string $table = 'joueur';
    protected string $entityClass = Joueur::class;
}
