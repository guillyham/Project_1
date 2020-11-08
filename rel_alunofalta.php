<?php
require 'conexao.php';
include ('pdf/mpdf.php');

$conexao = conexao::getInstance();
$sql = 'SELECT nome_aluno, total_falta FROM tab_dadosaluno';
$stm = $conexao->prepare($sql);
$stm->execute();
$dadosalunos = $stm->fetchAll(PDO::FETCH_OBJ);

$pagina = "";

$pagina .= "<h1>RELATÓRIO DE FALTAS</h1>";

$pagina .= "
        <TABLE BORDER=1 class=table table-striped width=100%>
          <tr class=active>
            <th>Nome</th>
            <th>Falta</th>
            <th>Situação</th>         
          </tr>
";

foreach($dadosalunos as $dadosaluno):
$pagina .= "
          <tr>
            <td>$dadosaluno->nome_aluno</td>
            <td>$dadosaluno->total_falta</td>
            <td>
           ";
              if ($dadosaluno->total_falta <= 20)
              {
                $pagina .= 'Aprovado'; 
              }
                else 
              {
                $pagina .= 'Reprovado'; 
              }
              $pagina .= "
            </td>
            </tr>
";

endforeach;

$pagina .= "</table>";

$arquivo = "rel_alunofalta.pdf";

$mpdf = new mPDF();

$mpdf->WriteHTML($pagina);

$mpdf->Output($arquivo, 'I');

?>