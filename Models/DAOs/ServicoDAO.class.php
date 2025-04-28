<?php 
    class ServicoDAO
    {
        public function __construct(
            private PDO $db
        ) {}

        private function return_obj(array $bd_data)  {
            // ! Retorna todos os dados recebidos do banco de dados em um array de objetos instânciados
            $return_data = [];
            foreach ($bd_data as $value) {
                $return_data[] = new Servico(
                    $value->idServico,
                    $value->descritivo,
                    $value->preco,
                    new Tipo($value->idTipo)    
                );
            };
            if (sizeof($bd_data) == 1) {
                return $return_data[0];
            } 
            else {
                return $return_data;
            }
        }   

        public function buscar_ultimo_servico_inserido()
        {
            $sql = "SELECT * FROM servico ORDER BY idServico DESC LIMIT 1";
            try 
            {
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                return $this->return_obj($stmt->fetchAll(PDO::FETCH_OBJ));
            }
            catch (PDOException $e) {
                die("Problema ao buscar o último serviço");
            }
        }

        public function buscar_todos_servicos() 
        {
            $sql = "SELECT * FROM servico";
            try 
            {
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                return $this->return_obj($stmt->fetchAll(PDO::FETCH_OBJ));
            } 
            catch (PDOException $e) 
            {
                die("Problema ao buscar os serviços");
            }
        }

        public function buscar_um_servico(Servico $servico) 
        {
            $sql = "SELECT * FROM servico WHERE idServico = :idServico";
            try
            {
                $stmt = $this->db->prepare($sql);
                $stmt->execute(
                    ["idServico"=> $servico->getIdServico()]
                );
                return $this->return_obj($stmt->fetchAll(PDO::FETCH_OBJ));
            }
            catch (PDOException $e)
            {
                die("Erro ao buscar serviço com id " . $servico->getIdServico());
            }
        }

        public function buscar_se_servico_existe(Servico $servico) 
        {
            $sql = "SELECT * FROM servico WHERE descritivo = :descritivo AND preco = :preco AND idTipo = :idTipo;";
            try 
            {
                $stmt = $this->db->prepare($sql);
                $stmt->execute(
                    [
                        "descritivo" => $servico->getDescritivo(),
                        "preco" => $servico->getPreco(),
                        "idTipo" => $servico->getTipo()->getIdTipo()
                    ]);
                return $this->return_obj($stmt->fetchAll(PDO::FETCH_OBJ));
            } 
            catch (PDOException $e) 
            {
                die("Erro ao buscar serviço com id " . $servico->getIdServico());
            }
        }

        public function inserir_servico(Servico $servico) 
        {
            $sql = "INSERT INTO servico (descritivo, preco, idTipo) VALUES (:descritivo, :preco, :idTipo);";
            try
            {
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    "descritivo" => $servico->getDescritivo(),
                    "preco"=> $servico->getPreco(),
                    "idTipo"=> $servico->getTipo()->getIdTipo()
                ]);
                return "Serviço inserido com sucesso";
            } 
            catch (PDOException $e)
            {
                die("Erro ao inserir serviço id " . $servico->getIdServico());
            }
        }

        public function inserir_ou_buscar_novo_servico(Servico $servico)
        {
            $db_resp = $this->buscar_se_servico_existe($servico);
            if (gettype($db_resp) != 'array') 
            {
                return $db_resp;
            }
            else
            {
                $this->inserir_servico($servico);
                return $this->buscar_ultimo_servico_inserido();
            }
        }

        public function buscar_dados_grafico()
		{
			$sql = "SELECT t.descritivo AS tipo, COUNT(*) AS quantidade 
            FROM agenda a
            INNER JOIN servico s ON a.idServico = s.idServico
            INNER JOIN tipo t ON s.idTipo = t.idTipo
            GROUP BY t.descritivo";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->execute();
				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(PDOException $e)
			{
				return "Problema ao buscar dados para o gráfico";
			}
		}
    }
?>