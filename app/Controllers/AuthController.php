<?php
namespace App\Controllers;
use App\Core\View; use App\Models\User;
class AuthController {
  public function loginForm(): void { View::render('auth/login'); }
  public function login(): void {
    verify_csrf();
    $email=trim($_POST['email']??'');$password=$_POST['password']??'';
    if(!$email||!$password){ flash('error','Informe email e senha'); redirect('/login'); }
    $user=(new User())->findByEmail($email);
    if(!$user||!password_verify($password,$user['password'])){ flash('error','Credenciais inválidas'); redirect('/login'); }
    session_regenerate_id(true); $_SESSION['user']=['id'=>$user['id'],'name'=>$user['name'],'email'=>$user['email']]; redirect('/');
  }
  public function logout(): void { session_destroy(); redirect('/login'); }
}
