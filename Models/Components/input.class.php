<?php
	class input implements componente
	{
		public function __construct(private string $nome, private string $tipo){}
		
		public function criar()
		{
			echo "<input name='$this->nome' id='$this->nome' type='$this->tipo'>";
		}
	}
?>