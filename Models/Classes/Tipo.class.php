<?php
    class Tipo
    {
        public function __construct(
            private int $id_tipo = 0,
            private string $descritivo = ''
        ){}
        
        public function getIdTipo(): int
        {
            return $this->id_tipo;
        }

        public function getDescritivo(): string
        {
            return $this->descritivo;
        }

        public function setIdTipo(int $id_tipo): void
        {
            $this->id_tipo = $id_tipo;
        }
        
        public function setDescritivo(string $descritivo): void
        {
            $this->descritivo = $descritivo;
        }
    }
?>