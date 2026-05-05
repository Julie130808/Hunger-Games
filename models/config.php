<?php
session_start();

/**
 * BASE_URL : détecté automatiquement
 * - En local (ex: http://localhost/HungerGames/) → "/HungerGames"
 * - Sur AlwaysData (site à la racine du domaine) → "" (chaîne vide)
 *
 * Permet d'utiliser <?= BASE_URL ?>/index.php partout sans codage en dur.
 */
if (!defined('BASE_URL')) {
    $projectDir = realpath(__DIR__ . '/..');
    $docRoot    = isset($_SERVER['DOCUMENT_ROOT']) ? realpath($_SERVER['DOCUMENT_ROOT']) : '';
    if ($docRoot && $projectDir && strpos($projectDir, $docRoot) === 0) {
        $base = str_replace('\\', '/', substr($projectDir, strlen($docRoot)));
        define('BASE_URL', rtrim($base, '/'));
    } else {
        define('BASE_URL', '');
    }
}

// 1) Si un fichier models/.env existe (cas local), on le charge dans $_ENV.
//    Le .env doit être dans .gitignore et ne PAS être uploadé sur AlwaysData.
$envPath = __DIR__ . '/.env';
if (is_file($envPath)) {
    $localEnv = parse_ini_file($envPath);
    if (is_array($localEnv)) {
        foreach ($localEnv as $k => $v) {
            if (!isset($_ENV[$k])) {
                $_ENV[$k] = $v;
            }
        }
    }
}

// 2) On lit ensuite via $_ENV ou getenv() (variables_order n'est pas toujours
//    réglé pareil ; getenv() est plus fiable sur AlwaysData).
function env_var(string $key, string $default = ''): string {
    $v = $_ENV[$key] ?? getenv($key);
    return ($v === false || $v === null || $v === '') ? $default : $v;
}

$dbHost     = env_var('DB_HOST');
$dbName     = env_var('DB_NAME');
$dbUser     = env_var('DB_USER');
$dbPass     = env_var('DB_PASS');
$adminLogin = env_var('ADMIN_LOGIN');
$adminPass  = env_var('ADMIN_PASS');

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Erreur de connexion : " . $e->getMessage());
}
?>