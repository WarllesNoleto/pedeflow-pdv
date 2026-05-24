<?php
namespace App\Controllers;
use App\Core\View; use App\Models\Driver;
class DriverController { public function index(): void { View::render('drivers/index',['items'=>(new Driver())->all()]); }
public function store(): void { verify_csrf(); $m=new Driver(); $id=(int)($_POST['id']??0); $data=['name'=>trim($_POST['name']),'phone'=>trim($_POST['phone']),'status'=>(int)($_POST['status']??1)]; if($id)$m->update($id,$data); else $m->create($data); flash('success','Entregador salvo'); redirect('/drivers'); }}
