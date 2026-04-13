<?php
require_once __DIR__ . '/../../models/config.php';
session_destroy();
header('Location: /HungerGames/index.php');
exit;
?>