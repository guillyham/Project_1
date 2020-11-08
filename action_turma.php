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
		$curso  = (isset($_POST['curso'])) ? $_POST['curso'] : '';
		$turno = (isset($_POST['turno'])) ? $_POST['turno'] : '';
		$turma = (isset($_POST['turma'])) ? $_POST['turma'] : '';
		$semestre = (isset($_POST['semestre'])) ? $_POST['semestre'] : '';



		// Verifica se foi solicitada a inclusão de dados
		if ($acao == 'incluir'):

			$consulta = 'SELECT turno, semestre, curso, turma FROM tab_turma';
			$con = $conexao->prepare($consulta);
			$retorno2 = $con->execute();
			$retorno2 =$con->fetch(PDO::FETCH_OBJ);

			if ($retorno2->turno == $turno && $retorno2->semestre == $semestre && $retorno2->curso == $curso && 
				$retorno2->turma == $turma)
			{
				echo "Registro ja existente";
				echo "<meta http-equiv=refresh content='3;URL=listarmartricula.php'>";
				exit;
			}

			$sql = 'INSERT INTO tab_turma (turno, semestre, curso, turma)  VALUES(:turno, :semestre, :curso, :turma)';

			$stm = $conexao->prepare($sql);
			$stm->bindValue(':turno', $turno);
			$stm->bindValue(':semestre', $semestre);
			$stm->bindValue(':curso', $curso);
			$stm->bindValue(':turma', $turma);
			$retorno = $stm->execute();
			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao inserir registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=listarturma.php'>";
		endif;

		// Verifica se foi solicitada a exclusão dos dados
		if ($acao == 'excluir'):

		

			// Exclui o registro do banco de dados
			$sql = 'DELETE FROM tab_turma WHERE id = :id';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(':id', $id);
			$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=listarturma.php'>";
		endif;
		?>

	</div>
</body>
</html>