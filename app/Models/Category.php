<?php
namespace App\Models;
class Category extends BaseCrudModel {
    protected string $table = 'categories';
    protected array $fillable = ['name','status','category_id','description','price','image','avg_prep_time','product_id','phone','address','district','reference_note','store_name','default_delivery_fee','avg_delivery_time','pix_key','whatsapp_template','order_type','payment_method','delivery_fee','discount','subtotal','total','notes','driver_id','customer_id','opened_by','opened_at','closed_at','opening_amount','closing_amount','cash_register_id','type','amount'];
}
