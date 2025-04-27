<?php
    class Cliente{
        public function __construct(
            private int $id_cliente = 0,
            private string $nome = "",
            private string $celular = ""
        ){}

        public function getIdCliente(): int
        {
            return $this->id_cliente;
        }
        
        public function getNome(): string
        {
            return $this->nome;
        }
        
        public function getCelular(): string
        {
            return $this->celular;
        }

        public function setIdCliente(int $id_cliente): void{
            $this->id_cliente = $id_cliente;
        }
        
        public function setNome(string $nome): void
        {
            $this->nome = $nome;
        }

        public function setCelular(string $celular): void
        {
            $this->celular = $celular;
        }
    }
?>