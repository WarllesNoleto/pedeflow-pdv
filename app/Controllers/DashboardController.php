<?php
namespace App\Controllers;
use App\Core\View; use App\Core\Database;
class DashboardController {
  public function index(): void {
    $db=Database::connection();
    $today=$db->query("SELECT COUNT(*) c, COALESCE(SUM(total),0) t FROM orders WHERE DATE(created_at)=CURDATE()")->fetch();
    $statuses=$db->query("SELECT status, COUNT(*) c FROM orders GROUP BY status")->fetchAll(); $map=[]; foreach($statuses as $s){$map[$s['status']]=$s['c'];}
    $ticket=$db->query("SELECT COALESCE(AVG(total),0) a FROM orders WHERE status<>'cancelado'")->fetch();
    $latest=$db->query("SELECT o.*,c.name customer_name FROM orders o LEFT JOIN customers c ON c.id=o.customer_id ORDER BY o.id DESC LIMIT 8")->fetchAll();
    View::render('dashboards/index',['today'=>$today,'map'=>$map,'ticket'=>$ticket,'latest'=>$latest]);
  }
}
