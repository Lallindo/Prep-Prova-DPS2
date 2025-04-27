<?php
    class td implements componente
    {
        public function __construct(private string $texto){}

        public function criar()
        {
            echo "<td>{$this->texto}</td>";
        }
    }
?>