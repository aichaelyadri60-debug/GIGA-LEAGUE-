<?php

class Matchs extends BaseEntity  {
    private int $id;
    private int $score_a;
    private int $score_b;
    private int $equipe_a;
    private int $equipe_b;
    private int $tournoi_id;
    private int $gagnant_id;

    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getScoreA(): int {
        return $this->score_a;
    }
    public function setScoreA(int $score): void {
        $this->score_a = $score;
    }

    public function getScoreB(): int {
        return $this->score_b;
    }
    public function setScoreB(int $score): void {
        $this->score_b = $score;
    }

    public function getEquipeA(): int {
        return $this->equipe_a;
    }
    public function setEquipeA(int $id): void {
        $this->equipe_a = $id;
    }

    public function getEquipeB(): int {
        return $this->equipe_b;
    }
    public function setEquipeB(int $id): void {
        $this->equipe_b = $id;
    }

    public function getTournoiId(): int {
        return $this->tournoi_id;
    }
    public function setTournoiId(int $id): void {
        $this->tournoi_id = $id;
    }

    public function getGagnantId(): int {
        return $this->gagnant_id;
    }
    public function setGagnantId(int $id): void {
        $this->gagnant_id = $id;
    }
}
