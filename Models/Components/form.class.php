<?php
	class form implements componente
	{
		public function __construct(private array $elementos = [], private string $id = '', private string $action = '', private string $method = ''){}
		
		public function criar()
		{
			echo "<form id='{$this->id}' action='{$this->action}' method='{$this->method}'>";
			foreach($this->elementos as $element)
			{
				$element->criar();
			}
			echo "</form>";
		}

		public function setElemento($elemento)
		{
			$this->elementos[] = $elemento;
		}
	}
?>