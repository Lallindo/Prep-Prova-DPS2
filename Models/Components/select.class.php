<?php
	class select implements componente
	{
		public function __construct(private string $name, private string $for, private array $elementos = []){}
		
		public function criar()
		{
			echo "<select name='{$this->name}' id='{$this->name}' for='{$this->for}'>";
            foreach($this->elementos as $elemento){
                $elemento->criar();
            }
            echo "</select>";
		}
		
		public function setElemento($elemento)
		{
			$this->elementos[] = $elemento;
		}
	}
?>