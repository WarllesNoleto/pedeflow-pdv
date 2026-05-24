<?php
namespace App\Models;
class CashMovement extends BaseCrudModel {
    protected string $table = 'cash_movements';
    protected array $fillable = ['cash_register_id','type','amount','payment_method','description'];
}
