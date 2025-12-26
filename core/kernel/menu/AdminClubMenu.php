<?php

class AdminClubMenu
{
    public static function show(): void
    {
        while (true) {
            Console::clear();
            Console::write("===== MENU ADMIN CLUB =====", "yellow");

            Console::write("1. Clubs");
            Console::write("2. Équipes");
            Console::write("3. Joueurs");
            Console::write("0. Retour");

            $choice = Console::read("Choix");

            switch ($choice) {
                case '1':
                    self::clubs();
                    break;

                case '2':
                    self::equipes();
                    break;

                case '3':
                    self::joueurs();
                    break;

                case '0':
                    return;

                default:
                    Console::write("❌ Choix invalide", "red");
                    self::pause();
            }
        }
    }

    private static function clubs(): void
    {
        Console::write("➡️ Gestion des clubs", "green");
        self::pause();
    }

    private static function equipes(): void
    {
        Console::write("➡️ Gestion des équipes", "green");
        self::pause();
    }

    private static function joueurs(): void
    {
        Console::write("➡️ Gestion des joueurs", "green");
        self::pause();
    }

    private static function pause(): void
    {
        Console::write("Appuyez sur Entrée...", "yellow");
        fgets(STDIN);
    }
}
