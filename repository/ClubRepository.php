<?php
require_once "./repository/BaseRepository.php";

class ClubRepository extends BaseRepository {
    protected string $table = 'club';
    protected string $entityClass = Club::class;

}
