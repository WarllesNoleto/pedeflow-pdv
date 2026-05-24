<?php
namespace App\Models;
use App\Core\Model;

class GenericModel extends Model {
    public function all(string $table): array { return $this->db()->query("SELECT * FROM {$table} ORDER BY id DESC")->fetchAll(); }
    public function insert(string $table, array $data): bool {
        $cols = implode(',', array_keys($data));
        $vals = implode(',', array_fill(0,count($data),'?'));
        $st=$this->db()->prepare("INSERT INTO {$table} ({$cols}) VALUES ({$vals})");
        return $st->execute(array_values($data));
    }
}
