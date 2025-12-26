<?php

require_once "./core/kernel/Autoloading.php";

Autoloading::LoadClass();

$db = new Database('localhost', 'root', 'aicha123', 'brief2php');
$db->connexion();

Kernel::start();
