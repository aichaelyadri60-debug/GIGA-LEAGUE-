<?php

class TournoiRepository extends BaseRepository implements CrudInterface{

    protected string $table = 'tournoi';
    protected string $entityClass = Tournoi::class;
}
