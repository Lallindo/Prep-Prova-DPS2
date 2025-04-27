<?php
    class tr implements componente
    {
        public function __construct(private array $elementos){}

        public function criar()
        {
            echo "<tr>";
            foreach ($this->elementos as $element) 
            {
                $element->criar();
            }
            echo "</tr>";
        }

        public function setElemento($elemento)
        {
            if (get_class($elemento) == "td" OR get_class($elemento) == "th")
            {
                $this->elementos[] = $elemento;
            }
            else 
            {
                echo "Erro ao inserir objeto na linha";
            }
        }
    }
?>