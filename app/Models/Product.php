<?php
namespace App\Models;
class Product extends BaseCrudModel {
    protected string $table = 'products';
    protected array $fillable = ['category_id','name','description','price','image','avg_prep_time','status'];
}
