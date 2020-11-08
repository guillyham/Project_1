<?php

require 'conexao.php';

// Recebe o termo de pesquisa se existir
$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';

// Verifica se o termo de pesquisa está vazio, se estiver executa uma consulta completa
  // Executa uma consulta baseada no termo de pesquisa passado como parâmetro
  $conexao = conexao::getInstance();
  $sql = 'SELECT a.nome, t.turno, t.semestre, t.curso, t.turma
          FROM tab_matricula m
          INNER JOIN tab_aluno a ON m.id_aluno = a.id
          INNER JOIN tab_turma t ON m.id_turma = t.id';
  $stm = $conexao->prepare($sql);
  $stm->execute();
  $matricula = $stm->fetchAll(PDO::FETCH_OBJ);

?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="fixed-nav sticky-footer bg-dark" id="page-top">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <a class="navbar-brand" href="index.php">FCV gestão escolar</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Home">
            <a class="nav-link" href="index.php">
              <i class="fa fa-fw fa-home"></i>
              <span class="nav-link-text">
                Home</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Aluno">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseAluno" data-parent="#exampleAccordion">
              <i class="fa fa-fw fa-user"></i>
              <span class="nav-link-text">
                Aluno</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseAluno">
              <li>
                <a href="cadastroaluno.php">Cadastrar Aluno</a>
              </li>
              <li>
                <a href="listaaluno.php">Lista de Alunos</a>
              </li>
               <li>
                <a href="faltas_aluno.php">Lancar Notas e Faltas</a>
              </li>
            </ul>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Curso">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseCurso" data-parent="#exampleAccordion">
              <i class="fa fa-fw fa-book"></i>
              <span class="nav-link-text">
                Curso</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseCurso">
              <li>
                <a href="cadastrocurso.php">Cadastrar Curso</a>
              </li>
              <li>
                <a href="listacurso.php">Lista de Cursos</a>
              </li>             
            </ul>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Turma">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseTurma" data-parent="#exampleAccordion">
              <i class="fa fa-fw fa-group"></i>
              <span class="nav-link-text">
                Turma</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseTurma">
              <li>
                <a href="cadastroturma.php">Cadastrar Turma</a>
              </li>
              <li>
                <a href="listarturma.php">Lista de Turmas</a>
              </li>
            </ul>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Cadastro de Matricula">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseCadastro" data-parent="#exampleAccordion">
              <i class="fa fa-fw fa-user-plus"></i>
              <span class="nav-link-text">
                Cadastro de Matricula</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseCadastro">
              <li>
                <a href="cadastromatricula.php">Cadastrar Matricula</a>
              </li>
              <li>
                <a href="listarmartricula.php">Listar matriculas</a>
              </li>
            </ul>
          </li>


          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Relatórios">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseRelatorio" data-parent="#exampleAccordion">
              <i class="fa fa-fw fa-file-pdf-o"></i>
              <span class="nav-link-text">
                Relatórios</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseRelatorio">
              <li>
                <a href="rel_alunos.php">Lista de Alunos </a>
              </li>
              <li>
                <a href="rel_cursos.php">Listar de Cursos</a>
              </li>
              <li>
                <a href="rel_aluturmas.php">Lista de Alunos e Turmas</a>
              <li>
                <a href="listarmartricula.php">Listar de Alunos, Notas e Situação</a>
              </li>
              <li>
                <a href="listarmartricula.php">Listar de Alunos, Faltas e Situação</a>
              </li>
              </li>
            </ul>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="FCV Drive">
            <a class="nav-link" href="#">
              <i class="fa fa-fw fa-link"></i>
              <span class="nav-link-text">
                FCV Drive</span>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
          <li class="nav-item">
            <a class="nav-link text-center" id="sidenavToggler">
              <i class="fa fa-fw fa-angle-left"></i>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <form class="form-inline my-2 my-lg-0 mr-lg-2">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Procurar por ...">
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
            </form>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
              <i class="fa fa-fw fa-sign-out"></i>
              Logout</a>
          </li>
        </ul>
      </div>  
    </nav>

  <?php if(!empty($matricula));?>

    <div class="content-wrapper">

      <div class="container-fluid">

        <!-- Example Tables Card -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-user"></i>
            Lista de Matriculas
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
              <thead>
                <tr class="active">
                    <th>Nome Aluno</th>
                    <th>Curso</th>
                    <th>semestre</th>
                    <th>turma</th>
                    <th>turno</th>
                    <th></th>
                  </tr>
              </thead> 
              <?php foreach ($matricula as $matricula):?>
                  <tr class="active">
                    <td><?=$matricula->nome?></td>
                    <td><?=$matricula->curso?></td>
                    <td><?=$matricula->semestre?></td>
                    <td><?=$matricula->turma?></td>
                    <td><?=$matricula->turno?></td>
                    <td>

                         <a href='javascript:void(0)' class="btn btn-danger link_exclusao" rel="<?=$matricula->id?>">Excluir</a>
                    </td>
                  </tr>
              <?php endforeach;?>

              </table>

            </div>

          </div>

        </div>

      </div>

      <!-- /.container-fluid -->

    </div>
    <!-- /.content-wrapper -->

    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright &copy; Your Website 2017</small>
        </div>
      </div>
    </footer>

    <!-- Scroll to Top Button -->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Select "Logout" below if you are ready to end your current session.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/sb-admin.min.js"></script>
    <script src="js/custom_matricula.js"></script>


  </body>

</html>
