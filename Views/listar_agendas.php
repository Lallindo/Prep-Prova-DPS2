<?php
	date_default_timezone_set("America/Sao_Paulo");
	require_once "vendor/autoload.php";
	$mpdf = new Mpdf/Mpdf();
	
	$header = "<h1>Agendas</h1>";
	
	$header .= "<br><br>" . date("d/m/Y");
	
	$body = "<br><br>
				<table>
					<tr>
						<th>Agenda</th>			
						<th>Serviço</th>			
						<th>Cliente</th>			
						<th>Data</th>			
						<th>Horário</th>		
					</tr>";
	foreach($retorno as $dado)
	{
		$body .= "<tr>
					<td>{$dado -> idAgenda}</td>
					<td>{$dado -> idServico}</td>
					<td>{$dado -> idCliente}</td>
					<td>{$dado -> data_agenda}</td>
					<td>{$dado -> horario}</td>
				</tr>";
	}
	$body .= "</table>";
	
	$html = $header . $body;
	
	$mpdf->WriteHTML($html);
	$mpdf->Output();
?>