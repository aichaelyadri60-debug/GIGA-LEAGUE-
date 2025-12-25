<?php

class SponsorsRepository extends BaseRepository implements CrudInterface{

    protected string $table = 'sponsors';
    protected string $entityClass = Sponsors::class;
}
