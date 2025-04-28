<?php
	date_default_timezone_set("America/Sao_Paulo");
	require_once "vendor/autoload.php";
	$mpdf = new \Mpdf\mpdf();
	
	$header = "<h1>Agendas</h1>";
	
	$header .= "<br><br>" . date("d/m/Y");
	
	$body = "<br><br>
				<table>
					<tr>
						<th>Agenda</th>			
						<th>Serviço</th>	
						<th>Desc. Serviço</th>
						<th>Preço</th>		
						<th>Tipo</th>
						<th>Desc. Tipo</th>
						<th>Cliente</th>	
						<th>Nome</th>
						<th>Celular</th>		
						<th>Data</th>			
						<th>Horário</th>		
					</tr>";
	foreach($retorno as $dado)
	{
		$body .= "<tr>
					<td>{$dado->getIdAgenda()}</td>
					<td>{$dado->getServico()->getIdServico()}</td>
					<td>{$dado->getServico()->getDescritivo()}</td>
					<td>{$dado->getServico()->getPreco()}</td>
					<td>{$dado->getServico()->getTipo()->getIdTipo()}</td>
					<td>{$dado->getServico()->getTipo()->getDescritivo()}</td>
					<td>{$dado->getCliente()->getIdCliente()}</td>
					<td>{$dado->getCliente()->getNome()}</td>
					<td>{$dado->getCliente()->getCelular()}</td>
					<td>{$dado->getDataAgenda()}</td>
					<td>{$dado->getHorario()}</td>
				</tr>";
	}
	$body .= "</table>";
	
	$html = $header . $body;
	
	$mpdf->WriteHTML($html);
	$mpdf->Output();
?>