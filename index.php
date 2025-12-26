<?php

require_once "./core/kernel/Autoloading.php";
Autoloading::LoadClass();

$db  = new Database('localhost', 'root', 'aicha123', 'brief2php');
$pdo = $db->connexion();

AdminClubMenu::init($pdo);
ClubMenu::init($pdo);
EquipeMenu::init($pdo);
JoueurMenu::init($pdo);

Kernel::start();
