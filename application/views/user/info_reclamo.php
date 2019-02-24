<?
	$rutaImagen = dirname(APPPATH) ."/public/img/reclamo/". $reclamo->imagen;
	$imagen = $reclamo->imagen;
	if(!file_exists($rutaImagen)) {
		$imagen = "default.jpg";
	}

	$label = "danger";

	if($reclamo->descripcion == "En proceso") {
		$label = "warning";
	}elseif($reclamo->descripcion == "Procesado") {
		$label = "success";
	}
?>
<div class="section section-info">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left"">Detalle del Reclamo</h2>
				<hr>

				<div class="row">
					<div class="col-sm-12">
						<div class="col-sm-6">
							</br></br>
							<span><strong>Reclamo:  &nbsp;&nbsp;&nbsp;</strong> <?php echo($reclamo->reclamo_decripcion)?></span>
							</br></br>
							<span><strong>Parque:  &nbsp;&nbsp;&nbsp;</strong><?php echo($reclamo->parque_nombre)?></span>
							</br></br>
							<span><strong>Comentarios:  &nbsp;&nbsp;&nbsp;</strong><?php echo($reclamo->comentarios)?></span>
							</br></br>
							<span><strong>Fecha y Horario:  &nbsp;&nbsp;&nbsp;</strong><?php echo date("d-m-Y H:i", strtotime($reclamo->fecha_creacion))?></span>
							</br></br>
							<span><strong>Estado del reclamo :  &nbsp;&nbsp;&nbsp;</strong><span style="font-size: 100%;" class="label label-<?echo($label)?>"><?php echo($reclamo->descripcion)?></span></span>
							</br></br>
							<span><strong>Compartir:  &nbsp;&nbsp;&nbsp;</strong><span><a href="https://plus.google.com/share?url=<?php echo base_url()?>&amp;text=Reclamo&nbsp;=&nbsp;<?echo($reclamo->reclamo_decripcion);?>%0DParque&nbsp;=&nbsp;<?echo($reclamo->parque_nombre);?>%0DComentarios&nbsp;=&nbsp;<?echo($reclamo->comentarios);?>%0D%0D<?echo base_url()?>&amp;hl=es" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="https://www.gstatic.com/images/icons/gplus-64.png" alt="Share on Google+"/></a></span>
							</br></br></br>
							<span><button type="button" class="btn btn-danger" id="modal_delete_reclamo">Eliminar Reclamo</button></span>
						</div>
						<div class="col-sm-6" text-align="center">
							</br>
							<img src="<?=base_url('public/img/reclamo') ."/". $imagen?>" class="img-responsive img-rounded"/>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Eliminar Usuario -->
<div id="modal_delete_reclamo_show" class="modal fade" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" style="color: #000000;">
					<img height="30" alt="Brand" src="<?=base_url('public/img').'/'.$logo?>">
					 <label style="color: #000000;">Eliminar Reclamo</label>
				</h4>
			</div>
			<div class="modal-body" id="myModalBody">
				<div class="form-group">
					<label for="email" style="color: #000000;">Atencion!</label>
					<p style="color: #000000;">Esta por eliminar el reclamo de la app Parques Bs As, si estas de acuerdo pulse el boton eliminar.</p>
				</div>
				<div class="form-group" style="text-align: center;" >
					<a class="btn btn-warning" href="<?=base_url()?>reclamo/eliminar/<?echo $reclamo->id_usuario_reclamo_parque?>/<?echo $reclamo->imagen?>">Eliminar</a>
					<br>
				</div>
				<div class="modal-footer">
					<input class="btn btn-danger" type="button" data-dismiss="modal" value="Cerrar"/>
				</div>
			</div>
		</div>
	</div>
</div>