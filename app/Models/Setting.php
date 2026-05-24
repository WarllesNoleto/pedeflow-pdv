<?php
namespace App\Models;
class Setting extends BaseCrudModel {
    protected string $table = 'settings';
    protected array $fillable = ['store_name','logo','phone','address','default_delivery_fee','avg_delivery_time','pix_key','whatsapp_template','status'];
}
