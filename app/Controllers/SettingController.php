<?php
namespace App\Controllers;
use App\Core\View; use App\Models\Setting;
class SettingController { public function index(): void { $m=new Setting(); $s=$m->find(1); View::render('settings/index',['setting'=>$s]); }
public function update(): void { verify_csrf(); $m=new Setting(); $data=['store_name'=>trim($_POST['store_name']),'phone'=>trim($_POST['phone']),'address'=>trim($_POST['address']),'default_delivery_fee'=>(float)$_POST['default_delivery_fee'],'avg_delivery_time'=>(int)$_POST['avg_delivery_time'],'pix_key'=>trim($_POST['pix_key']),'whatsapp_template'=>trim($_POST['whatsapp_template']),'status'=>(int)($_POST['status']??1)]; if($m->find(1))$m->update(1,$data); else $m->create($data); flash('success','Configurações atualizadas'); redirect('/settings'); }}
