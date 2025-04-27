<?php
    class table implements componente
    {
        public function __construct(private array $elementos){}

        public function criar()
        {
            echo "<table>";
            foreach ($this->elementos as $element) 
            {
                $element->criar();
            }
            echo "</table>";
        }

        public function setElemento($elemento)
        {
            if (get_class($elemento) == "tbody" OR get_class($elemento) == "thead")
            {
                $this->elementos[] = $elemento;
            }
            else 
            {
                echo "Erro ao inserir objeto na tabela";
            }
        }
    }
?>