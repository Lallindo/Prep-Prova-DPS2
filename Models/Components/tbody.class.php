<?php
    class tbody implements componente
    {
        public function __construct(private array $elementos){}

        public function criar()
        {
            echo "<tbody>";
            foreach ($this->elementos as $element) 
            {
                $element->criar();
            }
            echo "</tbody>";
        }

        public function setElemento($elemento)
        {
            if (get_class($elemento) == "tr")
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