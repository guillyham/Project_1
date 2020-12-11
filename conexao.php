<?php
function getPDO(){
	$options = [
		\PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
		\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
	];
	$dsn = "mysql:host=localhost:3307;dbname=project_1";
	try {
		return  new \PDO($dsn,"root","usbw", $options);
	} catch (\PDOException $e) {
		 echo "Erro de conexao com o banco de dados: ".$e->getMessage().$e->getCode();
		 exit();
	}
}