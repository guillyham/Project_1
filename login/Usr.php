<?php
class Usr 
{
    public function login($email, $senha){
        global $pdo;

        $sql = " SELECT * FROM usuarios WHERE Email = :email AND Senha = :senha";
        $sql = $pdo->prepare($sql);
        $sql-> bindValues("email", $email);
        $sql-> bindValues("senha", md5($senha));
        $sql->execute();

        if($sql-> rowCount()>0){
            $dado = $sql -> fetch() > 0;
            $_SESSION['idUsr'] = $dado['id'];
            return true;
        }
        else{
            return false;
        }
    }
}

?>