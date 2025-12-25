<?php

class Joueur extends BaseEntity {
    private int $id;
    private string $pseudo;
    private string $roleJ;
    private float $salaire;
    private int $id_equipe;

    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getPseudo(): string {
        return $this->pseudo;
    }
    public function setPseudo(string $pseudo): void {
        $this->pseudo = $pseudo;
    }

    public function getRoleJ(): string {
        return $this->roleJ;
    }
    public function setRoleJ(string $roleJ): void {
        $this->roleJ = $roleJ;
    }

    public function getSalaire(): float {
        return $this->salaire;
    }
    public function setSalaire(float $salaire): void {
        $this->salaire = $salaire;
    }

    public function getIdEquipe(): int {
        return $this->id_equipe;
    }
    public function setIdEquipe(int $idEquipe): void {
        $this->id_equipe = $idEquipe;
    }
}
