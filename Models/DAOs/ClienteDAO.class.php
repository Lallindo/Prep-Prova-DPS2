<?php

use function PHPSTORM_META\type;

    class ClienteDAO
    {
        public function __construct(
            private PDO $db
        ) {}

        private function return_obj(array $bd_data)  {
            // ! Retorna todos os dados recebidos do banco de dados em um array de objetos instânciados
            $return_data = [];
            foreach ($bd_data as $value) {
                $return_data[] = new Cliente(
                    $value->idCliente,
                    $value->nome,
                    $value->celular
                );
            };
            if (sizeof($bd_data) == 1) {
                return $return_data[0];
            } 
            else {
                return $return_data;
            }
        }   

        public function buscar_ultimo_cliente_inserido()
        {
            $sql = "SELECT * FROM cliente ORDER BY idCliente DESC LIMIT 1";
            try 
            {
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                return $this->return_obj($stmt->fetchAll(PDO::FETCH_OBJ));
            }
            catch (PDOException $e) {
                die("Problema ao buscar o último cliente");
            }
        }

        public function buscar_todos_clientes() 
        {
            $sql = "SELECT * FROM cliente";
            try 
            {
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                return $this->return_obj($stmt->fetchAll(PDO::FETCH_OBJ));
            } 
            catch (PDOException $e) 
            {
                die("Problema ao buscar os clientes");
            }
        }

        public function buscar_um_cliente(Cliente $cliente) 
        {
            $sql = "SELECT * FROM cliente WHERE idCliente = :idCliente";
            try
            {
                $stmt = $this->db->prepare($sql);
                $stmt->execute(
                    ["idCliente"=> $cliente->getIdCliente()]
                );
                return $this->return_obj($stmt->fetchAll(PDO::FETCH_OBJ));
            }
            catch (PDOException $e)
            {
                die("Erro ao buscar cliente com id " . $cliente->getIdCliente());
            }
        }

        public function buscar_se_cliente_existe(Cliente $cliente) 
        {
            $sql = "SELECT * FROM cliente WHERE nome = :nome AND celular = :celular;";
            try 
            {
                $stmt = $this->db->prepare($sql);
                $stmt->execute(
                    [
                        "nome" => $cliente->getNome(),
                        "celular" => $cliente->getCelular()
                    ]);
                return $this->return_obj($stmt->fetchAll(PDO::FETCH_OBJ));
            } 
            catch (PDOException $e) 
            {
                die("Erro ao buscar cliente com id ". $cliente->getIdCliente());
            }
        }

        public function inserir_cliente(Cliente $cliente) 
        {
            $sql = "INSERT INTO cliente (nome, celular) VALUES (:nome, :celular);";
            try
            {
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    "nome" => $cliente->getNome(),
                    "celular"=> $cliente->getCelular()
                ]);
                return "Serviço inserido com sucesso";
            } 
            catch (PDOException $e)
            {
                die("Erro ao inserir serviço id " . $cliente->getIdCliente());
            }
        }

        public function inserir_ou_buscar_novo_cliente(Cliente $cliente)
        {
            $db_resp = $this->buscar_se_cliente_existe($cliente);
            if (gettype($db_resp) != 'array') 
            {
                return $db_resp;
            }
            else
            {
                $this->inserir_cliente($cliente);
                return $this->buscar_ultimo_cliente_inserido();
            }
        }
    }
?>