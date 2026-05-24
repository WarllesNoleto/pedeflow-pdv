<?php
namespace App\Models;
class Order extends BaseCrudModel {
    protected string $table = 'orders';
    protected array $fillable = ['customer_id','driver_id','order_type','payment_method','status','subtotal','delivery_fee','discount','total','notes'];
}
