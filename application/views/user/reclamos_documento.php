<div class="section section-info">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left" "><b>Listado de reclamos</b></h2>
				<hr>
				<?php if(!empty($documentos)) {
					foreach($documentos as $key => $documento) { ?>

					<div class="panel panel-default">
						<div class="panel-heading">
							 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel" href="#panel-element-<?echo($key)?>"><?php echo($documento->nombre)?></a>
						</div>
						<div id="panel-element-<?echo($key)?>" class="panel-collapse collapse">
							<a class="btn btn-primary btn-lg btn-block" style="color: #fff; background-color: #337ab7; border-color: #2e6da4;" href="<?=base_url()?>reclamo/descargarDocumento	/<?=$documento->archivo?>">Descargar
							</a>

						</div>
					</div>
				<?php }
				} else {?>
					<strong><p style="color: #black; font-size: 18px ">Usted todavia no ha realizado ningun reclamo.</p></strong>
				<?php }?>
			</div>
			</br><br/><br/><br/><br/></br><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		</div>
	</div>
</div>