<?php
	class rotas
	{
		private array $rotas = array();
		
		public function get(string $nome, array $dados)
		{
			$this->rotas['GET'][$nome] = $dados;
		}
		public function post(string $nome, array $dados)
		{
			$this->rotas['POST'][$nome] = $dados;
		}
		public function verificar_rota(string $metodo, string $uri)
		{
			if(isset($this->rotas[$metodo][$uri]))
			{
				$dados_rota = $this->rotas[$metodo][$uri];
				$classe = $dados_rota[0];
				$metodo = $dados_rota[1];
				$obj = new $classe();
				return $obj->$metodo();
			}
			else
			{
				echo "Rota Inválida";
			}
		}
	}//fim da classe
	$route = new Rotas();
	$route->get("/", [inicioController::class,"inicio"]);
	$route->get("/listar-agendas", [AgendaController::class,"listarAgendas"]);
	$route->get("/listar-tipos", [AgendaController::class,"listarTipos"]);
	$route->get("/inserir", [AgendaController::class, "inserir"]);
	$route->post("/inserir", [AgendaController::class, "inserir"]);
	$route->get("/teste", [AgendaController::class,"teste"]);
	$route->get("/grafico", [AgendaController::class,"graficoPizza"]);
	$route->get("/grafico-dados", [AgendaController::class,"graficoDados"]);
?>