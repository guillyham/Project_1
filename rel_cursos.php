<?php
require 'conexao.php';
include ('pdf/mpdf.php');

$conexao = conexao::getInstance();
$sql = 'SELECT id, nome FROM tab_curso';
$stm = $conexao->prepare($sql);
$stm->execute();
$cursos = $stm->fetchAll(PDO::FETCH_OBJ);



$pagina = "";

$pagina .= "<h1>RELATÓRIO DE CURSOS</h1>";

$pagina .= "
        <table class=table table-striped width=10%>
          <tr class=active>
            <th>Nome</th>
            
           
          </tr>
";

foreach($cursos as $curso):
$pagina .= "
          <tr>
            <td>$curso->nome</td>
          <td>
              
            </td>
            
          </tr>
";

endforeach;

$pagina .= "</table>";

$arquivo = "rel_cursos.pdf";

$mpdf = new mPDF();

$mpdf->WriteHTML($pagina);

$mpdf->Output($arquivo, 'I');

?>