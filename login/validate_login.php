<?php 
if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])) {
    
    require_once '../conexao.php';
    require 'Usr.php';
    
    $user = new Usr();

    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    if($user->login($email, $senha) == true && isset($_SESSION['id'])){
      header("Location: .//index.php");
    }
    else{
       header("Location: login.php");
    }
}
else{
    /header("Location: login.php");
}

?>