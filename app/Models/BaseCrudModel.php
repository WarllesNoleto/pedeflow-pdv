<?php
namespace App\Models;

use App\Core\Model;

abstract class BaseCrudModel extends Model {
    protected string $table;
    protected array $fillable = [];

    public function all(): array { return $this->db()->query("SELECT * FROM {$this->table} ORDER BY id DESC")->fetchAll(); }
    public function find(int $id): ?array { $st=$this->db()->prepare("SELECT * FROM {$this->table} WHERE id=?"); $st->execute([$id]); return $st->fetch() ?: null; }
    public function create(array $data): bool { $data=$this->sanitize($data); $cols=implode(',',array_keys($data)); $vals=implode(',',array_fill(0,count($data),'?')); $st=$this->db()->prepare("INSERT INTO {$this->table} ({$cols}) VALUES ({$vals})"); return $st->execute(array_values($data)); }
    public function update(int $id, array $data): bool { $data=$this->sanitize($data); $set=implode(',',array_map(fn($c)=>"$c=?",array_keys($data))); $st=$this->db()->prepare("UPDATE {$this->table} SET {$set} WHERE id=?"); return $st->execute([...array_values($data),$id]); }
    public function delete(int $id): bool { $st=$this->db()->prepare("DELETE FROM {$this->table} WHERE id=?"); return $st->execute([$id]); }
    public function active(): array { $st=$this->db()->prepare("SELECT * FROM {$this->table} WHERE status=1 ORDER BY id DESC"); $st->execute(); return $st->fetchAll(); }
    protected function sanitize(array $data): array { return array_intersect_key($data, array_flip($this->fillable)); }
}
