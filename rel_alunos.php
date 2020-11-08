<?php
require 'conexao.php';
include ('pdf/mpdf.php');

$conexao = conexao::getInstance();
$sql = 'SELECT id, nome, cpf FROM tab_aluno';
$stm = $conexao->prepare($sql);
$stm->execute();
$alunos = $stm->fetchAll(PDO::FETCH_OBJ);



$pagina = "";

$pagina .= "<h1>RELATÓRIO DE ALUNOS</h1>";

$pagina .= "
        <TABLE BORDER=1 class=table table-striped width=100%>
          <tr class=active>
            <th>Nome</th>
            <th>CPF</th>
           
          </tr>
";

foreach($alunos as $aluno):
$pagina .= "
          <tr>
            <td>$aluno->nome</td>
            <td>$aluno->cpf</td>
          </tr>
";

endforeach;

$pagina .= "</table>";

$arquivo = "rel_alunos.pdf";

$mpdf = new mPDF();

$mpdf->WriteHTML($pagina);

$mpdf->Output($arquivo, 'I');

?>