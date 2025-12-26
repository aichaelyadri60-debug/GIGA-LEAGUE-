<?php

require_once "./core/kernel/Autoloading.php";
Autoloading::LoadClass();

class EquipeMenu
{
    private static PDO $pdo;

    public static function init(PDO $pdo): void
    {
        self::$pdo = $pdo;
    }


    public static function show(): void
    {
        while (true) {
            Console::clear();
            Console::write("===== MENU ÉQUIPE =====", "yellow");

            Console::write("1. Ajouter une équipe");
            Console::write("2. Modifier une équipe");
            Console::write("3. Supprimer une équipe");
            Console::write("4. Rechercher une équipe");
            Console::write("5. Liste des équipes");
            Console::write("6. Équipes par club");
            Console::write("7. Total équipes par club");
            Console::write("0. Retour");

            $choice = Console::read("Choix");

            switch ($choice) {
                case '1': self::create(); break;
                case '2': self::edit(); break;
                case '3': self::delete(); break;
                case '4': self::find(); break;
                case '5': self::findAll(); break;
                case '6': self::equipesParClub(); break;
                case '7': self::totalEquipesParClub(); break;
                case '0': return;

                default:
                    Console::write("Choix invalide", "red");
                    Console::pause();
            }
        }
    }

private static function create(): void
{
    Console::clear();
    Console::write("=== AJOUT ÉQUIPE ===", "yellow");

    $nomE   = Console::read("Nom de l'équipe");
    $jeu    = Console::read("Jeu");
    $idClub = (int) Console::read("ID du club");

    if (!$nomE || !$jeu || !$idClub) {
        Console::write("Tous les champs sont obligatoires", "red");
        Console::pause();
        return;
    }

    $clubRepo = new ClubRepository(self::$pdo);
    $club = $clubRepo->findOne($idClub);

    if (!$club) {
        Console::write(" Le club avec l'ID $idClub n'existe pas", "red");
        Console::pause();
        return;
    }

    try {
        $equipe = new Equipe();
        $equipe->setNomE($nomE);
        $equipe->setJeu($jeu);
        $equipe->setIdClub($idClub);

        $repo = new EquipeRepository(self::$pdo);
        $repo->create($equipe);

        Console::write("✅ Équipe ajoutée avec succès", "green");

    } catch (PDOException $e) {
        Console::write(" Erreur lors de l'ajout de l'equipe", "red");
    }

    Console::pause();
}


    private static function edit(): void
    {
        Console::clear();
        $id = (int) Console::read("ID de l'équipe");

        $repo = new EquipeRepository(self::$pdo);
        $equipe = $repo->findOne($id);

        if (!$equipe) {
            Console::write("Équipe introuvable", "red");
            Console::pause();
            return;
        }

        $equipe->setNomE(
            Console::read("Nom ({$equipe->getNomE()})") ?: $equipe->getNomE()
        );
        $equipe->setJeu(
            Console::read("Jeu ({$equipe->getJeu()})") ?: $equipe->getJeu()
        );
        $equipe->setIdClub(
            (int)(Console::read("ID Club ({$equipe->getIdClub()})") ?: $equipe->getIdClub())
        );

        $repo->update($equipe);

        Console::write("Équipe modifiée avec succès", "green");
        Console::pause();
    }

    private static function delete(): void
    {
        Console::clear();
        $id = (int) Console::read("ID de l'équipe");

        $repo = new EquipeRepository(self::$pdo);
        $repo->deleteById($id);

        Console::write("Équipe supprimée avec succès", "green");
        Console::pause();
    }

    private static function find(): void
    {
        Console::clear();
        $id = (int) Console::read("ID de l'équipe");

        $repo = new EquipeRepository(self::$pdo);
        $equipe = $repo->findOne($id);

        if (!$equipe) {
            Console::write("Équipe introuvable", "red");
        } else {
            Console::write("ID      : {$equipe->getId()}");
            Console::write("Nom     : {$equipe->getNomE()}");
            Console::write("Jeu     : {$equipe->getJeu()}");
            Console::write("ID Club : {$equipe->getIdClub()}");
        }

        Console::pause();
    }

    private static function findAll(): void
    {
        Console::clear();
        $repo = new EquipeRepository(self::$pdo);
        $equipes = $repo->findAll();

        if (empty($equipes)) {
            Console::write("Aucune équipe trouvée", "red");
        } else {
            foreach ($equipes as $equipe) {
                Console::write(
                    "{$equipe->getId()} | {$equipe->getNomE()} | {$equipe->getJeu()} | Club: {$equipe->getIdClub()}"
                );
            }
        }

        Console::pause();
    }
    private static function equipesParClub(): void
{
    Console::clear();
    Console::write("=== ÉQUIPES PAR CLUB ===", "yellow");

    $repo = new EquipeRepository(self::$pdo);
    $rows = $repo->clubByEquipe();

    if (empty($rows)) {
        Console::write("Aucune équipe trouvée", "red");
    } else {
        foreach ($rows as $row) {
            $club = $row['club'] ?? 'Aucun club';
            Console::write("Équipe : {$row['equipe']} | Club : {$club}");
        }
    }

    Console::pause();
}
private static function totalEquipesParClub(): void
{
    Console::clear();
    Console::write("=== TOTAL ÉQUIPES PAR CLUB ===", "yellow");

    $repo = new EquipeRepository(self::$pdo);
    $rows = $repo->totalEquipeByClub();

    if (empty($rows)) {
        Console::write("Aucune donnée", "red");
    } else {
        foreach ($rows as $row) {
            Console::write(
                "Club : {$row['club']} | Total équipes : {$row['total_equipes']}"
            );
        }
    }

    Console::pause();
}

}
