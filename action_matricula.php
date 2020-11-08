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
		$id_aluno  = (isset($_POST['aluno'])) ? $_POST['aluno']:'';
		$id_turma  = (isset($_POST['turma'])) ? $_POST['turma']:'';

		// Valida os dados recebido


		// Verifica se foi solicitada a inclusão de dados
		if ($acao == 'incluir'):

			$consulta = 'SELECT id_aluno,id_turma FROM tab_matricula';
			$con = $conexao->prepare($consulta);
			$retorno2 = $con->execute();
			$retorno2 =$con->fetch(PDO::FETCH_OBJ);

			if ($retorno2->id_aluno == $id_aluno && $retorno2->id_turma == $id_turma)
			{
				echo "Registro ja existente";
				echo "<meta http-equiv=refresh content='3;URL=listarmartricula.php'>";
				exit;
			}

			$sql = 'INSERT INTO tab_matricula (id_aluno,id_turma) VALUES (:id_aluno,:id_turma)';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(':id_turma', $id_turma);
			$stm->bindValue(':id_aluno', $id_aluno);
			$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao inserir registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=listarmartricula.php'>";
		endif;


		// Verifica se foi solicitada a exclusão dos dados
		if ($acao == 'excluir'):

			$sql = 'DELETE  FROM tab_matricula WHERE id = :id';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(':id', $id);
			$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=listarmartricula.php'>";
		endif;
		?>

	</div>
</body>
</html>