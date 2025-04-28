<?php
    class AgendaDAO
    {
        public function __construct(
            private PDO $db
        ) {}

        private function return_obj(array $bd_data)  {
            // ! Retorna todos os dados recebidos do banco de dados em um array de objetos instânciados
            $return_data = [];
            foreach ($bd_data as $value) {
                $return_data[] = new Agenda(
                    $value->idAgenda, 
                    $value->data_agenda, 
                    $value->horario, 
                    new Cliente(
                        $value->idCliente), 
                    new Servico(
                        $value->idServico));
            }
            if (sizeof($bd_data) == 1) {
                return $return_data[0];
            } 
            else {
                return $return_data;
            }
        }   

        public function buscar_todas_agendas() {
            $sql = "SELECT * FROM agenda";
            try 
            {
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                return $this->return_obj($stmt->fetchAll(PDO::FETCH_OBJ));
            } 
            catch (PDOException $e) 
            {
                die("Problema ao buscar as agendas");
            }
        }

        public function buscar_uma_agenda(Agenda $agenda) 
        {
            $sql = "SELECT * FROM agenda WHERE idAgenda = :idAgenda";
            try 
            {
                $stmt = $this->db->prepare($sql);
                $stmt->execute(
                    ["idAgenda" => $agenda->getIdAgenda()]
                );
                return $this->return_obj($stmt->fetchAll(PDO::FETCH_OBJ));
            }
            catch (PDOException $e) 
            {
                die("Erro ao buscar agenda com id " . $agenda->getIdAgenda());
            }
        }

        public function inserir_agenda(Agenda $agenda) {
            $sql = "INSERT INTO agenda (idServico, idCliente, data_agenda, horario) VALUES (:idServico, :idCliente, :data_agenda, :horario);";
            try
            {
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    "idServico" => $agenda->getServico()->getIdServico(),
                    "idCliente" => $agenda->getCliente()->getIdCliente(),
                    "data_agenda" => $agenda->getDataAgenda(),
                    "horario" => $agenda->getHorario(),
                ]);
                return "Agenda inserida com sucesso";
            } 
            catch (PDOException $e) 
            {
                die("Erro ao inserir agenda id " . $agenda->getIdAgenda());
            }
        }

        public function buscar_dados_pdf($curso)
		{
			$sql = "SELECT * FROM agenda";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $curso->getId_curso());
				$stm->execute();
				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(PDOException $e)
			{
				die("Problema ao buscar dados para o pdf");
			}
		}
    }
?>