<?php
namespace App\Controllers;
use App\Core\View; use App\Models\Product; use App\Models\Category;
class ProductController {
  public function index(): void { $q=trim($_GET['q']??'');$cat=(int)($_GET['category_id']??0);$items=(new Product())->all(); if($q) $items=array_values(array_filter($items,fn($i)=>stripos($i['name'],$q)!==false)); if($cat) $items=array_values(array_filter($items,fn($i)=>(int)$i['category_id']===$cat)); View::render('products/index',['items'=>$items,'categories'=>(new Category())->active()]); }
  public function store(): void { verify_csrf(); $m=new Product(); $id=(int)($_POST['id']??0); $data=['category_id'=>(int)$_POST['category_id'],'name'=>trim($_POST['name']),'description'=>trim($_POST['description']),'price'=>(float)$_POST['price'],'avg_prep_time'=>(int)$_POST['avg_prep_time'],'status'=>(int)($_POST['status']??1),'image'=>trim($_POST['image'])]; if($id)$m->update($id,$data); else $m->create($data); flash('success','Produto salvo'); redirect('/products'); }
}
