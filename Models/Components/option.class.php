<?php
	class option implements componente
	{
		public function __construct(private string $valor, private string $texto){}
		
		public function criar()
		{
			echo "<option value='{$this->valor}'>{$this->texto}</option>";
		}
	}
?>