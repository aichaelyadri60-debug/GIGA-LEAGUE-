<?php

require_once "./core/kernel/Autoloading.php";
Autoloading::LoadClass();

class AdminClubMenu
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
            Console::write("===== MENU ADMIN CLUB =====", "yellow");

            Console::write("1. Gérer les Clubs");
            Console::write("2. Gérer les Équipes");
            Console::write("3. Gérer les Joueurs");
            Console::write("0. Retour");

            $choice = Console::read("Choix");

            switch ($choice) {
                case '1':
                    ClubMenu::show();
                    break;

                case '2':
                    EquipeMenu::show();
                    break;

                case '3':
                    JoueurMenu::show();
                    break;

                case '0':
                    return;

                default:
                    Console::write("Choix invalide", "red");
                    Console::pause();
            }
        }
    }
}
