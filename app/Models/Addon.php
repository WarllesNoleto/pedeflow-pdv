<?php
namespace App\Models;
class Addon extends BaseCrudModel {
    protected string $table = 'product_addons';
    protected array $fillable = ['product_id','name','price','status'];
}
