<?php
require_once __DIR__ . '/../config.php';
session_destroy();
header('Location: /HungerGames/index.php');
exit;
?>