<?
	$rutaImagen = dirname(APPPATH) ."/public/img/reclamo/". $reclamo->imagen;
	$imagen = $reclamo->imagen;
	if(!file_exists($rutaImagen)) {
		$imagen = "default.jpg";
	}
?>
<div class="section section-info">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left" style="text-decoration: underline; ">Detalle del Reclamo</h2>
				</br></br>
				<div class="row">
					<div class="col-sm-7">
						<dl>
							<dt>Reclamo: <?php echo($reclamo->reclamo_decripcion)?></dt>
							<dt>Parque : <?php echo($reclamo->parque_nombre)?></dt>
							<dt>Comentarios :</dt>
							<dd><?php echo($reclamo->comentarios)?></dd>
							<dt>Fecha y Horario:</dt>
							<dd><?php echo($reclamo->fecha_creacion)?></dd>
							<dt>Estado del reclamo :</dt>
							<?php $label = "danger";
							if($reclamo->descripcion == "En proceso") {
								$label = "warning";
							}elseif($reclamo->descripcion == "Procesado") {
								$label = "success";
							}?>
							<dd><span class="label label-<?echo($label)?>"><?php echo($reclamo->descripcion)?></span></dd>
						</dl>
					</div>
					<div class="col-sm-5" text-align="center">
						<img src="<?=base_url('public/img/reclamo') ."/". $imagen?>" class="img-responsive img-rounded"/>
					</div>
          <a href="https://plus.google.com/share?url=<?php echo base_url()?>&amp;text=Reclamo&nbsp;=&nbsp;<?echo($reclamo->reclamo_decripcion);?>%0DParque&nbsp;=&nbsp;<?echo($reclamo->parque_nombre);?>%0DComentarios&nbsp;=&nbsp;<?echo($reclamo->comentarios);?>%0D%0D<?echo base_url()?>&amp;hl=es" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="https://www.gstatic.com/images/icons/gplus-64.png" alt="Share on Google+"/>
          </a>
          <button type="button" class="btn btn-danger" id="modal_delete_reclamo">Eliminar Reclamo</button>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- 
<a href="https://plus.google.com/share?url={adsasd}&amp;text=asdasd = dasdas%0Aasdasda%0asdasd%0dasdas = sddssd&amp;hl=es" onclick="javascript:window.open(this.href,
 '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img
 src="https://www.gstatic.com/images/icons/gplus-64.png" alt="Share on Google+"/></a>
<li> <a href="" id="modal_delete_user" data-toggle="modal">Eliminar Cuenta</a> </li>
-->

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