<?php
	class label implements componente
	{
		public function __construct(private string $for, private string $texto){}
		
		public function criar()
		{
			echo "<label for='{$this->for}'>$this->texto</label>";
		}
		
	}
?>