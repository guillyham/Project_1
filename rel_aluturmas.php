<?php
require 'conexao.php';
include ('pdf/mpdf.php');

  $conexao = conexao::getInstance();
  $sql = 'SELECT a.nome, t.turma
          FROM tab_matricula m
          INNER JOIN tab_aluno a ON m.id_aluno = a.id
          INNER JOIN tab_turma t ON m.id_turma = t.id';
  $stm = $conexao->prepare($sql);
  $stm->execute();
  $matriculas = $stm->fetchAll(PDO::FETCH_OBJ);

$pagina = "";

$pagina .= "<h1>RELATÓRIO DE ALUNO X TURMA</h1>";

$pagina .= "
        <TABLE BORDER=1 class=table table-striped width=100%>
          <tr class=active>
            <th>Nome</th>
            <th>Turma</th>
      
          </tr>
";

foreach($matriculas as $matricula):
$pagina .= "
          <tr>
            <td>$matricula->nome</td>
            <td>$matricula->turma</td>
         
          </tr>
";

endforeach;

$pagina .= "</table>";

$arquivo = "rel_aluturmas.pdf";

$mpdf = new mPDF();

$mpdf->WriteHTML($pagina);

$mpdf->Output($arquivo, 'I');

?>