<?php
namespace App\Models;
class Driver extends BaseCrudModel {
    protected string $table = 'delivery_drivers';
    protected array $fillable = ['name','phone','status'];
}
