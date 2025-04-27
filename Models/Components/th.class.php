<?php
    class th implements componente
    {
        public function __construct(private string $texto){}

        public function criar()
        {
            echo "<th>{$this->texto}</th>";
        }
    }
?>