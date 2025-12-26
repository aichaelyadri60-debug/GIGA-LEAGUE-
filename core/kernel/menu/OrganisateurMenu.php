<?php

class OrganisateurMenu
{
    public static function show(): void
    {
        while (true) {
            Console::clear();
            Console::write("===== MENU ORGANISATEUR =====", "yellow");

            Console::write("1. Gestion des tournois");
            Console::write("2. Gestion des matchs");
            Console::write("3. Sponsors");
            Console::write("0. Retour");

            $choice = Console::read("Choix");

            switch ($choice) {
                case '1':
                    self::tournois();
                    break;

                case '2':
                    self::matchs();
                    break;

                case '3':
                    self::sponsors();
                    break;

                case '0':
                    return;

                default:
                    Console::write("❌ Choix invalide", "red");
                    self::pause();
            }
        }
    }

    private static function tournois(): void
    {
        Console::write("➡️ Gestion des tournois", "green");
        self::pause();
    }

    private static function matchs(): void
    {
        Console::write("➡️ Gestion des matchs", "green");
        self::pause();
    }

    private static function sponsors(): void
    {
        Console::write("➡️ Gestion des sponsors", "green");
        self::pause();
    }

    private static function pause(): void
    {
        Console::write("Appuyez sur Entrée...", "yellow");
        fgets(STDIN);
    }
}
