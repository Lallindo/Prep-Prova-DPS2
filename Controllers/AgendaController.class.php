<?php
    require_once "Models/Components/componente.php";
    class AgendaController
    {   
        private $param;
        public function __construct() 
        {
            $this->param = Conexao::getInstancia();
        }

        public function listarAgendas()
		{
			//buscar os cursos no BD
			$agendaDAO = new AgendaDAO(db: $this->param);
            $servicoDAO = new ServicoDAO(db: $this->param);
            $clienteDAO = new ClienteDAO(db: $this->param);
            $tipoDAO = new TipoDAO(db: $this->param);
			$retorno = $agendaDAO->buscar_todas_agendas();

            if (gettype($retorno) == "array") {
                foreach ($retorno as $value) {
                    $value->setCliente($clienteDAO->buscar_um_cliente($value->getCliente()));
                    $value->setServico($servicoDAO->buscar_um_servico($value->getServico()));
                    $value->getServico()->setTipo($tipoDAO->buscar_um_tipo(($value->getServico()->getTipo())));
                }
            } else {
                $retorno->setCliente($clienteDAO->buscar_um_cliente($retorno->getCliente()));
                $retorno->setServico($servicoDAO->buscar_um_servico($retorno->getServico()));
            }

			//Mostrar os cursos para o usuário
			require_once "Views/listar_agendas.php";
		}

        public function listarTipos() 
        {
            $tipoDAO = new TipoDAO(db: $this->param);

            $retorno = $tipoDAO->buscar_todos_tipos();

            $table = new table([]);
            $thead = new thead([]);
            $tbody = new tbody([]);

            $tr_header = new tr([]);
            $tr_header->setElemento(new th("ID Tipo"));
            $tr_header->setElemento(new th("Descritivo"));

            $thead->setElemento($tr_header);

            $table->setElemento($thead);

            foreach ($retorno as $value) {
                $tr = new tr([]);
                $tr->setElemento(new td($value->getIdTipo()));
                $tr->setElemento(new td($value->getDescritivo()));
                $tbody->setElemento($tr);
            }

            $table->setElemento($tbody);

            require_once "Views/listar_tipos.php";
        }

        public function inserir()
        {
            $msg = "";
            $agendaDAO = new AgendaDAO(db: $this->param);
            $servicoDAO = new ServicoDAO(db: $this->param);
            $clienteDAO = new ClienteDAO(db: $this->param);
            $tipoDAO = new TipoDAO(db: $this->param);

            if ($_POST) 
            {
                date_default_timezone_set("America/Sao_Paulo");
                $tipo = new Tipo($_POST['inp-tipo']);
                $cliente = $clienteDAO->inserir_ou_buscar_novo_cliente(new Cliente(0, $_POST['inp-nome'], $_POST['inp-cel']));
                $servico = $servicoDAO->inserir_ou_buscar_novo_servico(new Servico(0, $_POST['inp-ser'], $_POST['inp-pre'], new Tipo($_POST['inp-tipo'])));
                $data_agend = date('Y-m-d');
                $horario = date('m-i-s');
                $agendaDAO->inserir_agenda(new Agenda(0, $data_agend, $horario, $cliente, $servico));
            }
            
            $retorno = $tipoDAO->buscar_todos_tipos();

            $formName = "form-agenda";
            $selectComp = new select("inp-tipo", $formName, []);

            $formComp = new form([],$formName,"", 'POST');
            
            foreach ($retorno as $valor) 
            {
                $selectComp->setElemento(new option($valor->getIdTipo(), $valor->getDescritivo()));
            }
            
            $formComp->setElemento(new label("inp-nome", "Nome:"));
            $formComp->setElemento(new br());
            $formComp->setElemento(new input("inp-nome", "text"));
            $formComp->setElemento(new br());
            $formComp->setElemento(new br());

            $formComp->setElemento(new label("inp-cel","Celular:"));
            $formComp->setElemento(new br());
            $formComp->setElemento(new input("inp-cel","tel"));
            $formComp->setElemento(new br());
            $formComp->setElemento(new br());

            $formComp->setElemento(new label("inp-ser","Serviço:"));
            $formComp->setElemento(new br());
            $formComp->setElemento(new input("inp-ser","text"));
            $formComp->setElemento(new br());
            $formComp->setElemento(new br());

            $formComp->setElemento(new label("inp-pre","Preço:"));
            $formComp->setElemento(new br());
            $formComp->setElemento(new input("inp-pre","number"));
            $formComp->setElemento(new br());
            $formComp->setElemento(new br());

            $formComp->setElemento(new label("inp-tipo", "Tipo:"));
            $formComp->setElemento(new br());
            $formComp->setElemento($selectComp);
            $formComp->setElemento(new br());
            $formComp->setElemento(new br());

            $formComp->setElemento(elemento: new input("","submit"));

            require_once "Views/agendar_servico.php"; 
        }

        public function graficoPizza(){
            require_once "Views/graficos.php";
        }

        public function graficoDados()
        {
            $servicoDAO = new ServicoDAO($this->param);
            $retorno = $servicoDAO->buscar_dados_grafico();
            // var_dump($retorno); // Para depuração
            echo json_encode($retorno);
            return json_encode($retorno);
            // require_once "Views/grafico_servicos_tipo.php";

        }

        public function gerar_pdf()
            {
                $msg = "";
                if($_POST)
                {
                        $agendaDAO = new AgendaDAO($this->param);
                        $ret = $agendaDAO->buscar_dados_pdf(new Agenda);
                        if(count($ret) > 0)
                        {
                            require_once "Views/listar_agenda.php";
                        }
                        else
                        {
                            $msg = "Curso sem alunos matriculados";
                        }
                }
                $agendaoDAO = new AgendaDAO($this->param);
                $retorno = $agendaoDAO->buscar_todas_agendas();
                require_once "Views/agendar_servicos.php";
            }  

        public function teste() 
        {
            $agendaDAO = new AgendaDAO(db: $this->param);
            $servicoDAO = new ServicoDAO(db: $this->param);
            $clienteDAO = new ClienteDAO(db: $this->param);

            //$retorno_clientes = $clienteDAO->buscar_todos_clientes();

            //$retorno_servicos = $servicoDAO->buscar_todos_servicos();

            //$retorno_agendas = $agendaDAO->buscar_todas_agendas();

            //$retorno_um_cliente = $clienteDAO->buscar_um_cliente(new Cliente(3));

            //$retorno_um_servico = $servicoDAO->buscar_um_servico(new Servico(3));

            //$retorno_uma_agenda = $agendaDAO->buscar_uma_agenda(new Agenda(4, '', '', cliente: new Cliente(), servico: new Servico()));

            //$servico = new Servico(0, "Teste3", 50, new Tipo(1));
            //$servicoDAO->inserir_servico($servico);

            //$cliente = new Cliente(0, 'Testes10', '01928394');
            //var_dump($clienteDAO->inserir_ou_buscar_novo_cliente($cliente));
            //var_dump($clienteDAO->buscar_ultimo_cliente_inserido());

            require_once "Views/teste.php";
        }

    }
?>