<?php
	require_once "Models/Components/componente.php";
	class inicioController
	{
		public function inicio()
		{
			$ul = new ul();
			$ul->setElemento(new li( [new a("/prep-prova/inserir", "Nova agenda")]));
			
			$ul->setElemento(new li([new a("/prep-prova/listar-agendas", "Agendas")])); 

			$ul->setElemento(new li([new a("/prep-prova/listar-tipos", "Tipos")])); 

			$ul->setElemento(new li([new a("/prep-prova/grafico-pizza", "Gráfico de Pizza")])); 
			
			require_once "Views/menu.php";
		}
	}
?>