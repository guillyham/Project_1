<?php
require_once '../conexao.php';
class Usr 
{
    public function login($email, $senha){
    $pdo = getPDO();
           
        $sql = "SELECT * FROM usuarios WHERE Email = '$email' AND Senha = '$senha'";
        $query = $pdo->query($sql);
        $f = $query->fetchAll();
        echo $sql;

        $i = 0;
        while(!empty($f[$i]))
        {
            $i++;   
        }

        if(!empty($f)) {
             $_SESSION['idUsr'] = $f['id'];
             $x = $f['Senha'];
            print_r($f);
            return true;
        }
        else{
            return false;
        }
    
    
    
    
    }
}

?>