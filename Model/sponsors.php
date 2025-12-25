<?php

class Sponsors extends BaseEntity {
    private int $id;
    private string $nom;
    private float $contribution_financiere;
    private int $tournoi_id;

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

    public function getContributionFinanciere(): float {
        return $this->contribution_financiere;
    }
    public function setContributionFinanciere(float $montant): void {
        $this->contribution_financiere = $montant;
    }

    public function getTournoiId(): int {
        return $this->tournoi_id;
    }
    public function setTournoiId(int $id): void {
        $this->tournoi_id = $id;
    }
}
