<?php
    class Servico
    {
        public function __construct(
            private int $id_servico = 0,
            private string $descritivo = '',
            private float $preco = 0,
            private Tipo $tipo = new Tipo()
        ){} 

        public function getIdServico(): int
        {
            return $this->id_servico;
        }

        public function getDescritivo(): string
        {
            return $this->descritivo;
        }

        public function getPreco(): int
        {
            return $this->preco;
        }

        public function getTipo(): Tipo
        {
            return $this->tipo;
        }

        public function setIdServico(int $id_servico): void
        {
            $this->id_servico = $id_servico;
        }

        public function setDescritivo(string $descritivo): void
        {
            $this->descritivo = $descritivo;
        }

        public function setPreco(int $preco): void
        {
            $this->preco = $preco;
        }

        public function setTipo(Tipo $tipo): void
        {
            $this->tipo = $tipo;
        }
    }
?>