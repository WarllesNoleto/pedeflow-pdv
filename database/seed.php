<?php
require __DIR__ . '/../app/Core/Database.php';
use App\Core\Database;

$pdo = Database::connection();
$hash = password_hash('123456', PASSWORD_DEFAULT);
$stmt = $pdo->prepare('INSERT INTO users (name,email,password,status) VALUES (?,?,?,1)');
$stmt->execute(['Administrador','admin@pedeflow.com',$hash]);

echo "Admin criado com sucesso.\n";
