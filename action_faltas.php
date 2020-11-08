<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Sistema de Cadastro</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
</head>
<body>
	<div class='container box-mensagem-crud'>
		<?php 
		require 'conexao.php';

		// Atribui uma conexão PDO
		$conexao = conexao::getInstance();

		// Recebe os dados enviados pela submissão
		$acao  = (isset($_POST['acao'])) ? $_POST['acao'] : '';
		$id    = (isset($_POST['id'])) ? $_POST['id'] : '';
		$nome_aluno = (isset($_POST['aluno'])) ? $_POST['aluno']:'';
		$total_falta  = (isset($_POST['faltas'])) ? $_POST['faltas']:'';
		$total_nota    = (isset($_POST['notas'])) ? $_POST['notas'] : '';

		// Valida os dados recebido


		// Verifica se foi solicitada a inclusão de dados
		if ($acao == 'incluir'):

			$consulta = 'SELECT nome_aluno FROM tab_dadosaluno';
			$con = $conexao->prepare($consulta);
			$retorno2 = $con->execute();
			$retorno2 =$con->fetch(PDO::FETCH_OBJ);

			if ($retorno2->nome_aluno == $nome_aluno)
			{
				echo "Registro ja existente";
				echo "<meta http-equiv=refresh content='3;URL=index.php'>";
				exit;
			}

			$sql = 'INSERT INTO tab_dadosaluno (nome_aluno, total_falta, total_nota) VALUES (:nome_aluno, :total_falta, :total_nota)';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(':nome_aluno', $nome_aluno);
			$stm->bindValue(':total_falta', $total_falta);
			$stm->bindValue(':total_nota', $total_nota);
			$retorno = $stm->execute();
			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao inserir registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=index.php'>";
		endif;

		?>

	</div>
</body>
</html>