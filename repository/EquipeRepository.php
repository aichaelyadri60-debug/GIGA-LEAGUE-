<?php

class EquipeRepository extends BaseRepository implements CrudInterface
{
    protected string $table = 'equipe';
    protected string $entityClass = Equipe::class;

    public function clubByEquipe(): array
    {
        $sql = "
            SELECT 
                c.Nom AS club,
                e.NomE AS equipe
            FROM equipe e
            LEFT JOIN club c ON e.idCLub = c.id
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function totalEquipeByClub(): array
    {
        $sql = "
            SELECT 
                c.Nom AS club,
                COUNT(e.id) AS total_equipes
            FROM club c
            LEFT JOIN equipe e ON e.idCLub = c.id
            GROUP BY c.id, c.Nom
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
