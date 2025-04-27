<?php
    class Agenda{
        public function __construct(
            public int $id_agenda = 0,
            public string $data_agenda = '',
            public string $horario = '',
            public Cliente $cliente,
            public Servico $servico
        ){}

        public function getIdAgenda(): int
        {
            return $this->id_agenda;
        }

        public function getCliente(): Cliente
        {
            return $this->cliente;
        }

        public function getServico(): Servico
        {
            return $this->servico;
        }

        public function getDataAgenda(): string
        {
            return $this->data_agenda;
        }

        public function getHorario(): string
        {
            return $this->horario;
        }

        public function setIdAgenda(int $agenda): void
        {
            $this->id_agenda = $agenda;
        }

        public function setCliente(Cliente $cliente): void
        {
            $this->cliente = $cliente;
        }

        public function setServico(Servico $servico): void
        {
            $this->servico = $servico;
        }

        public function setDataAgenda(string $data_agenda): void
        {
            $this->data_agenda = $data_agenda;
        }

        public function setHorario(string $horario): void
        {
            $this->horario = $horario;
        }

    }
?>