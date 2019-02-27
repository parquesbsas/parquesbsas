<div class="section section-info">
	<div class="container">
		<div class="row">
			<br>
			<div class="col-md-12" style="display: flex; align-items: center; justify-content: center;">
				<div class="col-md-6">
					<img src="<?echo base_url('public/img/404.jpg')?>" class="img-responsive img-rounded center-block">
				</div>
				<div class="col-md-6">
					<h1 style="font-size: 75px;"><?= !empty($numeroError) ? $numeroError : "404"?></h1>
					<h2><?= !empty($descripcion) ? $descripcion : "Ups, esta pagina no se encuentra disponible"?></h2>
				</div>
			</div>
		</div>
	</div>
</div>
<br>