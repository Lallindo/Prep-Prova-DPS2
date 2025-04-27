<!doctype html>
<html>
	<head>
		<title>Agendas</title>
		<meta charset="UTF-8">
	</head>
	<body>
		<h1>Lista de Agendas</h1>
		<br>
		<table border="1">
			<tr>
				<th>Agenda</th>
				<th>Data</th>
				<th>Horário</th>
				<th>Serviço</th>
				<th>Desc. Servico</th>
				<th>Preço</th>
				<th>Tipo</th>
				<th>Desc. Tipo</th>
				<th>Cliente</th>
				<th>Nome</th>
				<th>Celular</th>
			</tr>
			<?php
				foreach($retorno as $dado)
				{
					echo "
					<tr>
						<td>{$dado->id_agenda}</td>
						<td>{$dado->data_agenda}</td>
						<td>{$dado->horario}</td>	  
						<td>{$dado->servico->getIdServico()}</td>
						<td>{$dado->servico->getDescritivo()}</td>
						<td>{$dado->servico->getPreco()}</td>
						<td>{$dado->servico->getTipo()->getIdTipo()}</td>
						<td>{$dado->servico->getTipo()->getDescritivo()}</td>
						<td>{$dado->cliente->getIdCliente()}</td>
						<td>{$dado->cliente->getNome()}</td>
						<td>{$dado->cliente->getCelular()}</td>
					</tr>";
				}
			?>
		</table>
	</body>
</html>