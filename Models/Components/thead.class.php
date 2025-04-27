<?php
    class thead implements componente
    {
        public function __construct(private array $elementos){}

        public function criar()
        {
            echo "<thead>";
            foreach ($this->elementos as $element) 
            {
                $element->criar();
            }
            echo "</thead>";
        }

        public function setElemento($elemento)
        {
            if (get_class($elemento) == "tr" and count($this->elementos) == 0)
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