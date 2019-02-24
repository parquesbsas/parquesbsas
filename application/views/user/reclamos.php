<div class="section section-info">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left" "><b>Listado de reclamos</b></h2>
				<hr>
				<?php if(!empty($reclamos)) {
					foreach($reclamos as $key => $reclamo) { ?>
						<?$reclamo->fecha_creacion = date("d-m-Y H:i", strtotime($reclamo->fecha_creacion));?>
					<div class="panel panel-default">
						<div class="panel-heading">
							 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel" href="#panel-element-<?echo($key)?>"><?php echo($reclamo->reclamo_decripcion ."  /  ". $reclamo->parque_nombre ."  /  ". $reclamo->fecha_creacion)?></a>
						</div>
						<div id="panel-element-<?echo($key)?>" class="panel-collapse collapse">
							<a class="btn btn-primary btn-lg btn-block" style="color: #fff; background-color: #337ab7; border-color: #2e6da4;" href="<?=base_url()?>reclamo/detalle/<?=$reclamo->id_usuario_reclamo_parque?>">Detalle
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