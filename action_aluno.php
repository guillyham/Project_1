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
		$nome  = (isset($_POST['nome'])) ? $_POST['nome'] : '';
		$cpf  = (isset($_POST['cpf'])) ? $_POST['cpf'] : '';

		// Valida os dados recebidos
		$mensagem = '';
		if ($acao == 'editar' && $id == ''):
		    $mensagem .= '<li>ID do registros desconhecido.</li>';
	    endif;

	    // Se for ação diferente de excluir valida os dados obrigatórios
	    if ($acao != 'excluir'):
			if ($nome == '' || strlen($nome) < 3):
				$mensagem .= '<li>Favor preencher o Nome.</li>';
		    endif;


			if ($mensagem != ''):
				$mensagem = '<ul>' . $mensagem . '</ul>';
				echo "<div class='alert alert-danger' role='alert'>".$mensagem."</div> ";
				exit;
			endif;
		endif;



		// Verifica se foi solicitada a inclusão de dados
		if ($acao == 'incluir'):

			$sql = 'INSERT INTO tab_aluno (nome, cpf)
							   VALUES(:nome,  :cpf)';

			$stm = $conexao->prepare($sql);
			$stm->bindValue(':nome', $nome);
			$stm->bindValue(':cpf', $cpf);
			$retorno = $stm->execute();
			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao inserir registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=listaaluno.php'>";
		endif;


		// Verifica se foi solicitada a edição de dados
		if ($acao == 'editar'):

			$sql = 'UPDATE tab_aluno SET nome=:nome, cpf=:cpf  ';
			$sql .= 'WHERE id = :id';

			$stm = $conexao->prepare($sql);
			$stm->bindValue(':nome', $nome);
			$stm->bindValue(':cpf', $cpf);
			$stm->bindValue(':id', $id);
			$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao editar registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=listaaluno.php'>";
		endif;


		// Verifica se foi solicitada a exclusão dos dados
		if ($acao == 'excluir'):

		

			// Exclui o registro do banco de dados
			$sql = 'DELETE FROM tab_aluno WHERE id = :id';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(':id', $id);
			$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=listaaluno.php'>";
		endif;
		?>

	</div>
</body>
</html>