<?php
namespace App\Controllers;
use App\Core\View; use App\Models\Customer;
class CustomerController { public function index(): void { $q=trim($_GET['q']??'');$items=(new Customer())->all(); if($q)$items=array_values(array_filter($items,fn($c)=>stripos($c['name'],$q)!==false||stripos($c['phone'],$q)!==false)); View::render('customers/index',['items'=>$items]); }
public function store(): void { verify_csrf(); $m=new Customer(); $id=(int)($_POST['id']??0); $data=['name'=>trim($_POST['name']),'phone'=>trim($_POST['phone']),'address'=>trim($_POST['address']),'district'=>trim($_POST['district']),'reference_note'=>trim($_POST['reference_note']),'status'=>(int)($_POST['status']??1)]; if($id)$m->update($id,$data); else $m->create($data); flash('success','Cliente salvo'); redirect('/customers'); }}
