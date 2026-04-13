<?php
function emailDejaUtilise(PDO $pdo, string $email): bool
{
    $stmt = $pdo->prepare("SELECT id_user FROM USER_ WHERE email = :email");
    $stmt->execute(['email' => $email]);
    return (bool)$stmt->fetch();
}

function creerUtilisateur(PDO $pdo, string $name, string $email, string $password): int
{
    $pdo->prepare("
        INSERT INTO USER_ (name, email, password, conditions)
        VALUES (:name, :email, :password, 'accepted')
    ")->execute([
        'name'     => $name,
        'email'    => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
    ]);
    return (int)$pdo->lastInsertId();
}
?>