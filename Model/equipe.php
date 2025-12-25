<?php

class Equipe extends BaseEntity  {
    private int $id;
    private string $nomE;
    private string $jeu;
    private int $idClub;

    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getNomE(): string {
        return $this->nomE;
    }
    public function setNomE(string $nomE): void {
        $this->nomE = $nomE;
    }

    public function getJeu(): string {
        return $this->jeu;
    }
    public function setJeu(string $jeu): void {
        $this->jeu = $jeu;
    }

    public function getIdClub(): int {
        return $this->idClub;
    }
    public function setIdClub(int $idClub): void {
        $this->idClub = $idClub;
    }
}
