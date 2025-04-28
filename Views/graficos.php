<!doctype html>
<html>
	<head>
		<title>Serviços - Gráfico de Pizza</title>
		<meta charset="UTF-8">
		<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	</head>
	<body>
		<h1>Serviços agendados por tipo - Gráfico de pizza</h1>
		<div id="chart"></div>
		
		<script>
			fetch("/prep-prova/grafico-dados")
			.then(response => response.json())
			.then(dados => {
				if (dados.length > 0) {
					gerar_grafico_pizza(dados);
				} else {
					document.getElementById("chart").innerHTML = "<h1>Não há dados para geração do gráfico</h1>";
				}
			})
			.catch((err) => {
				console.log(err);
				alert("Deu ruim");
			});
						
			function gerar_grafico_pizza(dados)
			{
				var valores = [];
				var legendas = [];

				for(var x = 0; x < dados.length; x++) {
					legendas.push(dados[x].tipo); 
					valores.push(parseInt(dados[x].quantidade));  // 1, 1
				}
				
				var options = {
					series: valores,
					chart: {
						width: 380,
						type: 'pie',
					},
					labels: legendas,  // Tipos: Limpeza, Consultoria
					responsive: [{
						breakpoint: 480,
						options: {
							chart: {
								width: 200
							},
							legend: {
								position: 'bottom'
							}
						}
					}],
					stroke: {
						width: 0
					},
					grid: {
						row: {
							colors: ['#fff', '#f2f2f2']
						}
					},
					fill: {
						type: 'gradient',
						gradient: {
							shade: 'light',
							type: "horizontal",
							shadeIntensity: 0.25,
							gradientToColors: undefined,
							inverseColors: true,
							opacityFrom: 0.85,
							opacityTo: 0.85,
							stops: [50, 0, 100]
						},
					}
				}

				var chart = new ApexCharts(document.querySelector("#chart"), options);
				chart.render();
			}

		</script>
		
	</body>
</html>