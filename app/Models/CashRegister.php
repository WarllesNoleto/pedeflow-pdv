<?php
namespace App\Models;
class CashRegister extends BaseCrudModel {
    protected string $table = 'cash_registers';
    protected array $fillable = ['opened_by','opened_at','closed_at','opening_amount','closing_amount','status'];
}
