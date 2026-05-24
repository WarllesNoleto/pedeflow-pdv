<?php
namespace App\Models;
class Category extends BaseCrudModel {
    protected string $table = 'categories';
    protected array $fillable = ['name','status'];
}
