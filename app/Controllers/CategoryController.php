<?php
namespace App\Controllers;
use App\Core\View; use App\Models\Category; use App\Models\Product;
class CategoryController {
  public function index(): void { View::render('categories/index',['items'=>(new Category())->all()]); }
  public function store(): void {
    verify_csrf(); $m=new Category(); $id=(int)($_POST['id']??0); $name=trim($_POST['name']??'');
    if($name===''){ flash('error','Nome obrigatório'); redirect('/categories'); }
    if($id){ $m->update($id,['name'=>$name,'status'=>(int)($_POST['status']??1)]);} else { $m->create(['name'=>$name,'status'=>1]); }
    flash('success','Categoria salva'); redirect('/categories');
  }
  public function delete(): void { verify_csrf(); $id=(int)$_POST['id']; $p=new Product(); foreach($p->all() as $prod){ if((int)$prod['category_id']===$id){ flash('error','Categoria possui produtos'); redirect('/categories'); }} (new Category())->delete($id); flash('success','Categoria removida'); redirect('/categories'); }
  public function toggle(): void { verify_csrf(); $m=new Category(); $id=(int)$_POST['id']; $c=$m->find($id); $m->update($id,['status'=>$c['status']?0:1]); flash('success','Status atualizado'); redirect('/categories'); }
}
