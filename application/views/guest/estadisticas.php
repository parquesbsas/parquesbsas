<div class="section section-info">
	<div class="container">
		<div class="row">
			<div class="col-md-12">   
			<h2 class="text-left">Estadisticas :</h2>
				</br></br></br></br>
				<div id="contenedor_estadisticas_cantidad_reclamos">
					<canvas id="chart_cantidad_reclamos" width="840" height="240"></canvas>
				</div>

				</br></br></br></br></br></br>
				<div id="contenedor_estadisticas_cantidad_usuarios">
					<canvas id="chart_cantidad_usuarios" width="840" height="240"></canvas>
				</div>

				</br></br></br></br></br></br>
				<div id="contenedor_estadisticas_mayor_reclamo">
					<canvas id="chart_mayor_reclamo" width="840" height="240"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	//Cantidad de reclamos Por Mes
	$.post("<?php echo base_url();?>estadisticas/obtenerReclamosPorMes", function(data) {
		var obj = JSON.parse(data);

		meses2 = [];
		total = [];
		bgColor = [];
		bgBorder = [];
		$.each(obj, function(i,item){
		//	contenedor_estadisticas_mayor_reclamo.log(i,item);
			var r = Math.random() * 255;
			r = Math.round(r);

			var g = Math.random() * 255;
			g = Math.round(g);

			var b = Math.random() * 255;
			b = Math.round(b);

			meses2.push(i);
			total.push(item);
			bgColor.push('rgba('+r+','+g+','+b+', 0.3)');
			bgBorder.push('rgba('+r+','+g+','+b+', 1)');
		});
		
		var ctx = $("#chart_cantidad_reclamos");
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: meses2,
				datasets: [{
					label: "Cantidad de Reclamos",
					data: total,
					backgroundColor: bgColor,
					borderColor: bgBorder,
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true,
							stepSize: 1
						}
					}]
				},
				title: {
					display: true,
					fontSize: 13,
					text: "Cantidad de reclamos por mes"
				}
			}
		});		
	});
</script>

<script>
	//Cantidad de usuarios Por Mes
	$.post("<?php echo base_url();?>estadisticas/obtenerUsuariosPorMes", function(data) {
		var obj = JSON.parse(data);

		meses3 = [];
		total2 = [];
		backgroundColor = "rgba(54, 162, 235, 0.2)";
		borderColor = "rgba(54, 162, 235, 1)";
		$.each(obj, function(i,item){
		//	console.log(i,item);
			meses3.push(i);
			total2.push(item);
		});
		
		var ctx = $("#chart_cantidad_usuarios");
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: meses3,
				datasets: [{
					label: "Cantidad de Usuarios",
					data: total2,
					backgroundColor: backgroundColor,
					borderColor: borderColor,
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true,
							stepSize: 1
						}
					}]				
				},
				title: {
					display: true,
					fontSize: 13,
					text: "Cantidad de usuarios registrados por mes"
				}
			}
		});		
	});
</script>


<script>
	//Reclamo mas votado por mes
	$.post("<?php echo base_url();?>estadisticas/obtenerMayorReclamoPorMes", function(data) {
		var obj = JSON.parse(data);

		meses4 = [];
		total3 = [];
		bgColor2 = [];
		bgBorder2 = [];
		$.each(obj, function(i,item){
			
			var r = Math.random() * 255;
			r = Math.round(r);

			var g = Math.random() * 255;
			g = Math.round(g);

			var b = Math.random() * 255;
			b = Math.round(b);

			console.log(i,item);
			$.each(item, function(ii, value) {

				meses4.push(i +" | Reclamo : "+ value.descripcion);
				total3.push(value.total);
				console.log(ii,value);
			});

			bgColor2.push('rgba('+r+','+g+','+b+', 0.3)');
			bgBorder2.push('rgba('+r+','+g+','+b+', 1)');
		});
		
		var ctx = $("#chart_mayor_reclamo");
		var myChart = new Chart(ctx, {
			type: 'horizontalBar',
			data: {
				labels: meses4,
				datasets: [{
					label: "Cantidad de reclamos",
					data: total3,
					backgroundColor: bgColor2,
					borderColor: bgBorder2,
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true,
							stepSize: 1
						}
					}],
					xAxes: [{
						ticks: {
							beginAtZero:true,
							stepSize: 1
						}
					}]
				},
				title: {
					display: true,
					fontSize: 13,
					text: "Reclamo mas solicitado por mes"
				}				
			}
		});		
	});
</script>