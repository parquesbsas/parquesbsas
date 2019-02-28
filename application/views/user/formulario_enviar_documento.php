<div class="section section-info">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h2 class="text-left">Enviar Documento</h2>
				<?if(!empty($ongsBarrios)) {?>
					<a class="btn btn-success" id="mod_ongs">Ver Informacion Ongs</a>
				<?}?>

			</div>
		</div>

		<hr>
		<br>

		<div class="row">
			<div class="col-md-12">
	 			<?php echo form_open("reclamo/enviarEmail", array("id" => "form-admin-reclamo", "class" => "form-horizontal")) ?>

					<div class="form-group">
						<div class="col-sm-2">
							<label for="email_comuna" class="control-label" style="color: #000000;">Email Comuna : &nbsp;&nbsp;&nbsp;
							</label>
						</div>
						<div class="col-sm-8">
							<input id ="email_comuna" name="email_comuna" type="text" class="form-control" placeholder="Email Comuna">
							<p class="error_reclamo_email_comuna text-danger"></p>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label for="email_ong" class="control-label" style="color: #000000;">Email ONG : &nbsp;&nbsp;&nbsp;
							</label>
						</div>
						<div class="col-sm-8">
							<input id ="email_ong" name="email_ong" type="text" class="form-control" placeholder="Email ONG">
							<p class="error_reclamo_email_ong text-danger"></p>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label for="reclamo_documento" class="control-label" style="color: #000000;">Cargar Documento : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-8">
							<input accept=".docx" type="file" name="fileDocumento" id="fileDocumento" class="form-control">
							<p class="error_fileDocument text-danger"></p>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<div class="col-sm-2">
							<label for="comentario" style="color: #000000;">Comentarios : &nbsp;&nbsp;&nbsp;
								<span style="font-size:85%;" class="label label-warning">Requerido</span>
							</label>
						</div>
						<div class="col-sm-8">
							<textarea id="comentario_reclamo_email" class="form-control" name="comentario" style="max-width: 100%" rows="2" style="color: #000000;" placeholder="Escriba sus comentarios..."></textarea>
							<p class="error_reclamo_comentario text-danger"></p>
						</div>
					</div>
					<hr>

					<div class="form-group">
						<label  class="control-label col-xs-4"></label><!-- borre en label for="nombre" -->
						<div class="col-sm-offset-2 col-sm-10">
							<button id="enviar_email_reclamo" type='submit' class="btn btn-default" onclick="cargando_reclamos_enviar_email()">Enviar</button>
						</div>
					</div>
					<p id="cargar_form_enviar_reclamo_email" style="font-weight: bold;"><font color="green">Cargando....</font></p>
					<p id="error_form_enviar_reclamo_documento_email" class="errorform_enviar_reclamo_documento_email text-danger" style="font-weight: bold;"></p>
				</form>
			</div>
		</div>
	</div>
</div>

<?if(!empty($ongsBarrios)) {?>
	<!-- ventana modal ongs -->
	<div id="modal_ongs" class="modal fade" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" style="overflow-y: initial; height: 500px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" style="color: #000000;">
							<img height="30" alt="Brand" src="<?=base_url('public/img').'/'.$logo?>"> Ong's
						</h4>
				</div>
				<div class="modal-body" id="myModalBody" style="overflow-y: auto; height: 370px;">
					<div class="form-group">
						 <p style="color: #000000; font-weight: bold; text-align: center; font-size: 19px;">Ong's por Barrio</p>
					</div>
						<?php $init = 0;
							foreach($ongsBarrios as $nombreBarrio => $ongBarrio) {
							$init++;
						?>
						<div class="panel panel-success class" style="color:#000000; background-color:#FFFFFF;">
							<div class="panel-heading" style="color: #000000;">
								<center>
									<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel" href="#panel-element-activity-<?echo($init)?>"><?php echo($nombreBarrio)?>
									</a>
								</center>
							</div>
							<div id="panel-element-activity-<?echo($init)?>" class="panel-collapse collapse">
								</br>
								<div class="row">
									<div class="col-md-12">
										<span><strong>Parques: </strong><?echo(empty($ongBarrio->parques) ? "No tiene" : $ongBarrio->parques)?></span>
										</br></br>
									<?php foreach($ongBarrio->ongs as $ong) {?>
										<span><strong>Nombre ong: </strong><?echo($ong->nombre_ong)?></span>
										</br>
										<span><strong>Telefono y email de la ong: </strong><?echo($ong->telefono_ong ." / ". $ong->email_ong)?></span>
										</br>
										<span><strong>Nombre y apellido del referente: </strong><?echo($ong->nombre_referente ." ". $ong->apellido_referente)?></span>
										</br>
										<span><strong>Telefono y email del referente: </strong><?echo($ong->email_referente)?>
										</br></br>
									<?}?>
									</div>
								</div>
							</div>
						</div>
					<?php }?>
				</div>
				<div class="modal-footer">
					<input class="btn btn-danger" type="button" data-dismiss="modal" value="Cerrar" />
				</div>
			</div>
		</div>
	</div>
<?}?>