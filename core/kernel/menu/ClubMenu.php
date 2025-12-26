<?php

require_once "./core/kernel/Autoloading.php";
Autoloading::LoadClass();

class ClubMenu
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
            Console::write("===== MENU CLUB =====", "yellow");

            Console::write("1. Ajouter un club");
            Console::write("2. Modifier un club");
            Console::write("3. Supprimer un club");
            Console::write("4. Rechercher un club");
            Console::write("5. Liste des clubs");
            Console::write("0. Retour");

            $choice = Console::read("Choix");

            switch ($choice) {
                case '1': self::create(); break;
                case '2': self::edit(); break;
                case '3': self::delete(); break;
                case '4': self::find(); break;
                case '5': self::findAll(); break;
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
        Console::write("=== AJOUT CLUB ===", "yellow");

        $nom   = Console::read("Nom");
        $ville = Console::read("Ville");
        $date  = Console::read("Date création (YYYY-MM-DD)");

        if (!$nom || !$ville || !$date) {
            Console::write("Tous les champs sont obligatoires", "red");
            Console::pause();
            return;
        }

        $club = new Club();
        $club->setNom($nom);
        $club->setVille($ville);
        $club->setDateCreation($date);

        $repo = new ClubRepository(self::$pdo);
        $repo->create($club);

        Console::write("Club ajouté avec succès", "green");
        Console::pause();
    }

    private static function edit(): void
    {
        Console::clear();
        $id = (int) Console::read("ID du club");

        $repo = new ClubRepository(self::$pdo);
        $club = $repo->findOne($id);

        if (!$club) {
            Console::write("Club introuvable", "red");
            Console::pause();
            return;
        }

        $club->setNom(
            Console::read("Nom ({$club->getNom()})") ?: $club->getNom()
        );
        $club->setVille(
            Console::read("Ville ({$club->getVille()})") ?: $club->getVille()
        );

        $repo->update($club);

        Console::write("Club modifié avec succès", "green");
        Console::pause();
    }

    private static function delete(): void
    {
        Console::clear();
        $id = (int) Console::read("ID du club");

        $repo = new ClubRepository(self::$pdo);
        $repo->deleteById($id);

        Console::write("Club supprimé avec succès", "green");
        Console::pause();
    }

    private static function find(): void
    {
        Console::clear();
        $id = (int) Console::read("ID du club");

        $repo = new ClubRepository(self::$pdo);
        $club = $repo->findOne($id);

        if (!$club) {
            Console::write("Club introuvable", "red");
        } else {
            Console::write("ID    : {$club->getId()}");
            Console::write("Nom   : {$club->getNom()}");
            Console::write("Ville : {$club->getVille()}");
        }

        Console::pause();
    }

    private static function findAll(): void
    {
        Console::clear();
        $repo = new ClubRepository(self::$pdo);
        $clubs = $repo->findAll();

        if (empty($clubs)) {
            Console::write("Aucun club trouvé", "red");
        } else {
            foreach ($clubs as $club) {
                Console::write(
                    "{$club->getId()} | {$club->getNom()} | {$club->getVille()}"
                );
            }
        }

        Console::pause();
    }
}
