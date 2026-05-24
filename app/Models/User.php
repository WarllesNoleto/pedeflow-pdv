<?php
namespace App\Models;
use App\Core\Model;

class User extends Model {
    protected string $table = 'users';
    public function findByEmail(string $email): ?array {
        $st=$this->db()->prepare('SELECT * FROM users WHERE email=? LIMIT 1');
        $st->execute([$email]);
        return $st->fetch() ?: null;
    }
}
