<?php
	class li implements componente
	{
		public function __construct(private $elementos = []){}
		
		public function criar()
		{
			echo "<li>";
			foreach($this->elementos as $dado)
			{
				$dado->criar();
			}
			echo "</li>";
		}
	}
?>