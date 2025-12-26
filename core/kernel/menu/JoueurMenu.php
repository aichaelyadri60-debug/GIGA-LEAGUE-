<?php

class JoueurMenu
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
            Console::write("===== MENU JOUEUR =====", "yellow");
            Console::write("1. Ajouter un joueur");
            Console::write("2. Modifier un joueur");
            Console::write("3. Supprimer un joueur");
            Console::write("4. Rechercher un joueur");
            Console::write("5. Liste des joueurs");
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
        Console::write("=== AJOUT JOUEUR ===", "yellow");

        $pseudo     = Console::read("Pseudo");
        $roleJ      = Console::read("Rôle");
        $salaire    = (float) Console::read("Salaire");
        $idEquipe   = (int) Console::read("ID équipe");

        if (!$pseudo || !$roleJ || !$salaire || !$idEquipe) {
            Console::write("Tous les champs sont obligatoires", "red");
            Console::pause();
            return;
        }

        $equipeRepo = new EquipeRepository(self::$pdo);
        $equipe = $equipeRepo->findOne($idEquipe);

        if (!$equipe) {
            Console::write("L'équipe avec l'ID $idEquipe n'existe pas", "red");
            Console::pause();
            return;
        }

        try {
            $joueur = new Joueur();
            $joueur->setPseudo($pseudo);
            $joueur->setRoleJ($roleJ);
            $joueur->setSalaire($salaire);
            $joueur->setIdEquipe($idEquipe);

            $repo = new JoueurRepository(self::$pdo);
            $repo->create($joueur);

            Console::write("✅ Joueur ajouté avec succès", "green");
        } catch (PDOException $e) {
            Console::write("Erreur lors de l'ajout du joueur", "red");
        }

        Console::pause();
    }


    private static function edit(): void
    {
        Console::clear();
        $id = (int) Console::read("ID du joueur");

        $repo = new JoueurRepository(self::$pdo);
        $joueur = $repo->findOne($id);

        if (!$joueur) {
            Console::write("Joueur introuvable", "red");
            Console::pause();
            return;
        }

        $joueur->setPseudo(
            Console::read("Pseudo ({$joueur->getPseudo()})") ?: $joueur->getPseudo()
        );
        $joueur->setRoleJ(
            Console::read("Rôle ({$joueur->getRoleJ()})") ?: $joueur->getRoleJ()
        );
        $joueur->setSalaire(
            (float)(Console::read("Salaire ({$joueur->getSalaire()})") ?: $joueur->getSalaire())
        );

        $repo->update($joueur);

        Console::write("✅ Joueur modifié", "green");
        Console::pause();
    }


    private static function delete(): void
    {
        Console::clear();
        $id = (int) Console::read("ID du joueur");

        $repo = new JoueurRepository(self::$pdo);
        $repo->deleteById($id);

        Console::write("✅ Joueur supprimé", "green");
        Console::pause();
    }


    private static function find(): void
    {
        Console::clear();
        $id = (int) Console::read("ID du joueur");

        $repo = new JoueurRepository(self::$pdo);
        $joueur = $repo->findOne($id);

        if (!$joueur) {
            Console::write("Joueur introuvable", "red");
        } else {
            Console::write("ID        : {$joueur->getId()}");
            Console::write("Pseudo    : {$joueur->getPseudo()}");
            Console::write("Rôle      : {$joueur->getRoleJ()}");
            Console::write("Salaire   : {$joueur->getSalaire()}");
            Console::write("ID équipe : {$joueur->getIdEquipe()}");
        }

        Console::pause();
    }


    private static function findAll(): void
    {
        Console::clear();
        $repo = new JoueurRepository(self::$pdo);
        $joueurs = $repo->findAll();

        if (empty($joueurs)) {
            Console::write("Aucun joueur trouvé", "red");
        } else {
            foreach ($joueurs as $j) {
                Console::write(
                    "{$j->getId()} | {$j->getPseudo()} | {$j->getRoleJ()} | {$j->getSalaire()} | Équipe: {$j->getIdEquipe()}"
                );
            }
        }

        Console::pause();
    }
}
