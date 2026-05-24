<?php
require __DIR__ . '/../app/Core/Database.php';
use App\Core\Database;
$pdo = Database::connection();

$st=$pdo->prepare('SELECT id FROM users WHERE email=?'); $st->execute(['admin@pedeflow.com']);
if(!$st->fetch()){ $hash=password_hash('123456', PASSWORD_DEFAULT); $pdo->prepare('INSERT INTO users (name,email,password,status) VALUES (?,?,?,1)')->execute(['Administrador','admin@pedeflow.com',$hash]); echo "Admin criado.\n"; } else { echo "Admin já existe.\n"; }

$pdo->exec("INSERT INTO settings (id,store_name,phone,address,default_delivery_fee,avg_delivery_time,whatsapp_template) VALUES (1,'PedeFlow PDV','(11) 99999-0000','Rua Exemplo, 123',5,45,'Olá, quero finalizar meu pedido!') ON DUPLICATE KEY UPDATE store_name=VALUES(store_name)");
$pdo->exec("INSERT IGNORE INTO categories (name,status) VALUES ('Lanches',1),('Bebidas',1),('Sobremesas',1)");
$pdo->exec("INSERT IGNORE INTO products (category_id,name,description,price,avg_prep_time,status) VALUES (1,'X-Burger','Pão, carne, queijo',24.9,20,1),(2,'Refrigerante Lata','350ml',6.0,1,1)");

echo "Seeds aplicadas.\n";
