<?php
require 'conexao.php';
include ('pdf/mpdf.php');

$conexao = conexao::getInstance();
$sql = 'SELECT nome_aluno, total_nota FROM tab_dadosaluno';
$stm = $conexao->prepare($sql);
$stm->execute();
$dadosalunos = $stm->fetchAll(PDO::FETCH_OBJ);

$pagina = "";

$pagina .= "<h1>RELATÓRIO DE NOTAS</h1>";

$pagina .= "
        <table class=table table-striped width=55%>
          <tr class=active>
            <th>Nome</th>
            <th>Nota</th>
            <th>Situação</th>
           
          </tr>
";

foreach($dadosalunos as $dadosaluno):
$pagina .= "
          <tr>
            <td>$dadosaluno->nome_aluno</td>
            <td>$dadosaluno->total_nota</td>
            <td>
        ";

              if ($dadosaluno->total_nota >= 70)
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

$arquivo = "rel_alunonota.pdf";

$mpdf = new mPDF();

$mpdf->WriteHTML($pagina);

$mpdf->Output($arquivo, 'I');

?>