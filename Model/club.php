<?php

class Club extends BaseEntity {
    private int $id;
    private string $nom;
    private string $ville;
    private string $date_creation;

    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getNom(): string {
        return $this->nom;
    }
    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function getVille(): string {
        return $this->ville;
    }
    public function setVille(string $ville): void {
        $this->ville = $ville;
    }

    public function getDateCreation(): string {
        return $this->date_creation;
    }
    public function setDateCreation(string $date): void {
        $this->date_creation = $date;
    }
}
