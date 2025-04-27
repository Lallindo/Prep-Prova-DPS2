<?php
    class TipoDAO {
        public function __construct(
            private PDO $db
        ) {}

        private function return_obj(array $bd_data)  {
            // ! Retorna todos os dados recebidos do banco de dados em um array de objetos instânciados
            $return_data = [];
            foreach ($bd_data as $value) {
                $return_data[] = new Tipo(
                    $value->idTipo,
                    $value->descritivo
                );
            };
            if (sizeof($bd_data) == 1) {
                return $return_data[0];
            } 
            else {
                return $return_data;
            }
        }  

        public function buscar_todos_tipos() {
            $sql = "SELECT * FROM tipo";
            try 
            {
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                return $this->return_obj($stmt->fetchAll(PDO::FETCH_OBJ));
            } 
            catch (PDOException $e) 
            {
                die("Problema ao buscar os tipos");
            }
        }

        public function buscar_um_tipo(Tipo $tipo) 
        {
            $sql = "SELECT * FROM tipo WHERE idTipo = :idTipo";
            try
            {
                $stmt = $this->db->prepare($sql);
                $stmt->execute(
                    ["idTipo"=> $tipo->getIdTipo()]
                );
                return $this->return_obj($stmt->fetchAll(PDO::FETCH_OBJ));
            }
            catch (PDOException $e)
            {
                die("Erro ao buscar tipo com id " . $tipo->getIdTipo());
            }
        }
    }
?>