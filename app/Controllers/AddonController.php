<?php
namespace App\Controllers;
use App\Core\View; use App\Models\Addon; use App\Models\Product;
class AddonController { public function index(): void { View::render('addons/index',['items'=>(new Addon())->all(),'products'=>(new Product())->active()]); }
public function store(): void { verify_csrf(); $m=new Addon(); $id=(int)($_POST['id']??0); $data=['product_id'=>$_POST['product_id']!==''?(int)$_POST['product_id']:null,'name'=>trim($_POST['name']),'price'=>(float)$_POST['price'],'status'=>(int)($_POST['status']??1)]; if($id)$m->update($id,$data); else $m->create($data); flash('success','Adicional salvo'); redirect('/addons'); }}
