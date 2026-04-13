<?php
require_once __DIR__ . '/../../../models/config.php';
require_once __DIR__ . '/../../../models/admin/jeux/liste.php';

if (!isset($_SESSION['admin'])) {
    header('Location: ../../login.php');
    exit;
}

$jeux = obtenirTousLesJeux($pdo);

require_once __DIR__ . '/../../../views/admin/jeux/liste.php';
?>