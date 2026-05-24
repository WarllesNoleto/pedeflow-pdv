<?php
namespace App\Models;
class Customer extends BaseCrudModel {
    protected string $table = 'customers';
    protected array $fillable = ['name','phone','address','district','reference_note','status'];
}
