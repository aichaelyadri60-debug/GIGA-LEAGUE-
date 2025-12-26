<?php
require_once "./src/Console.php";
require_once "./core/kernel/menu/OrganisateurMenu.php";
require_once "./core/kernel/menu/AdminClubMenu.php";
class Kernel
{
    public static function start(): void
    {
        while (true) {
            Console::clear();
            Console::write("=====================================", "yellow");
            Console::write("      GIGA-LEAGUE MANAGER (CLI)", "yellow");
            Console::write("=====================================", "yellow");

            Console::write("1️⃣  Organisateur");
            Console::write("2️⃣  Admin de Club");
            Console::write("0️⃣  Quitter");

            $role = Console::read("Choisissez votre rôle");

            switch ($role) {
                case '1':
                    OrganisateurMenu::show();
                    break;

                case '2':
                    AdminClubMenu::show();
                    break;

                case '0':
                    Console::write("👋 À bientôt", "green");
                    exit;

                default:
                    Console::write("❌ Choix invalide", "red");
                    self::pause();
            }
        }
    }

    private static function pause(): void
    {
        Console::write("Appuyez sur Entrée...", "yellow");
        fgets(STDIN);
    }
}
