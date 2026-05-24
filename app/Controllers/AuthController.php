<?php
namespace App\Controllers;
use App\Core\View;
use App\Models\User;

class AuthController {
  public function loginForm(): void { View::render('auth/login'); }
  public function login(): void {
    $email=trim($_POST['email']??'');$password=$_POST['password']??'';
    if(!$email||!$password){ flash('error','Informe email e senha'); redirect('/pedeflow-pdv/public/login'); }
    $user=(new User())->findByEmail($email);
    if(!$user||!password_verify($password,$user['password'])){ flash('error','Credenciais inválidas'); redirect('/pedeflow-pdv/public/login'); }
    session_regenerate_id(true); $_SESSION['user']=['id'=>$user['id'],'name'=>$user['name'],'email'=>$user['email']];
    redirect('/pedeflow-pdv/public/');
  }
  public function logout(): void { session_destroy(); redirect('/pedeflow-pdv/public/login'); }
}
