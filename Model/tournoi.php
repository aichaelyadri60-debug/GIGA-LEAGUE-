<?php

class Tournoi extends BaseEntity {
    private int $id;
    private string $titre;
    private float $cashprize;
    private string $format;
    private string $date_tournoi;

    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getTitre(): string {
        return $this->titre;
    }
    public function setTitre(string $titre): void {
        $this->titre = $titre;
    }

    public function getCashprize(): float {
        return $this->cashprize;
    }
    public function setCashprize(float $cashprize): void {
        $this->cashprize = $cashprize;
    }

    public function getFormat(): string {
        return $this->format;
    }
    public function setFormat(string $format): void {
        $this->format = $format;
    }

    public function getDateTournoi(): string {
        return $this->date_tournoi;
    }
    public function setDateTournoi(string $date): void {
        $this->date_tournoi = $date;
    }
}
