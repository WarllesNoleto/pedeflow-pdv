<?php
namespace App\Controllers;
use App\Core\View;
use App\Models\GenericModel;

class ProductController {
  public function index(): void {
    $model = new GenericModel();
    
    View::render('products/index', ['items'=>[]]);
  }
  public function store(): void { flash('success','Registro salvo com sucesso'); redirect('/pedeflow-pdv/public/products'); }
  public function kanban(): void { View::render('orders/kanban', ['orders'=>[]]); }
  public function updateStatus(): void { flash('success','Status atualizado'); redirect('/pedeflow-pdv/public/orders/kanban'); }
  public function movement(): void { flash('success','Movimento registrado'); redirect('/pedeflow-pdv/public/cash'); }
  public function update(): void { flash('success','Configurações atualizadas'); redirect('/pedeflow-pdv/public/settings'); }
}
